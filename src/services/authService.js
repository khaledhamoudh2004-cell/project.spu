import { reactive, readonly } from "vue";
import api, { setUnauthorizedHandler } from "./api";
import {
  clearAuthSession as clearStoredAuthSession,
  getStoredToken,
  getStoredUser,
  saveAuthSession
} from "./authStorage";

const isDev = import.meta.env.DEV;

function debugLog(...args) {
  if (isDev) {
    console.log("[AUTH]", ...args);
  }
}

const authState = reactive({
  token: getStoredToken(),
  user: getStoredUser(),
  initialized: false,
  restoring: false
});

function setSession(token, user) {
  authState.token = token;
  authState.user = user || null;
  saveAuthSession(token, user || null);
}

function clearSession() {
  authState.token = null;
  authState.user = null;
  clearStoredAuthSession();
}

function hasRole(requiredRoles = []) {
  if (requiredRoles.length === 0) {
    return true;
  }

  const userRole = authState.user?.role;

  return Boolean(userRole && requiredRoles.includes(userRole));
}

function getRouteByRole(role) {
  if (role === "manager") {
    return { name: "manager-overview" };
  }

  if (role === "pharmacist") {
    return { name: "pharmacist-inventory" };
  }

  return { name: "patient-search" };
}

async function fetchMe() {
  debugLog("Fetching current user from /auth/me");
  const response = await api.get("/auth/me");
  const user = response.data?.user || null;

  if (authState.token) {
    saveAuthSession(authState.token, user);
  }

  authState.user = user;
  return user;
}

async function restoreSession() {
  if (authState.initialized || authState.restoring) {
    return isAuthenticated();
  }

  if (!authState.token) {
    debugLog("No stored token. Session restore skipped.");
    authState.initialized = true;
    return false;
  }

  authState.restoring = true;

  try {
    debugLog("Token found. Restoring session...");
    await fetchMe();
    authState.initialized = true;
    return true;
  } catch {
    debugLog("Stored token is invalid/expired. Clearing session.");
    clearSession();
    authState.initialized = true;
    return false;
  } finally {
    authState.restoring = false;
  }
}

function isAuthenticated() {
  return Boolean(authState.token);
}

async function login({ identifier, password, tokenName = "web" }) {
  debugLog("Login called", {
    identifier,
    tokenName
  });

  const response = await api.post("/auth/login", {
    identifier,
    password,
    token_name: tokenName
  });

  debugLog("Login response received", {
    status: response.status,
    hasToken: Boolean(response.data?.token),
    role: response.data?.user?.role || null
  });

  const token = response.data?.token;
  const user = response.data?.user || null;

  if (!token) {
    throw new Error("Authentication token was not returned by the backend.");
  }

  setSession(token, user);
  authState.initialized = true;

  return response.data;
}

async function logout() {
  debugLog("Logout called");
  let remoteLogoutSucceeded = false;

  try {
    if (authState.token) {
      await api.post("/auth/logout");
      remoteLogoutSucceeded = true;
    }
  } catch (error) {
    debugLog("Logout API failed. Clearing local session anyway.", error);
  } finally {
    // Fail-safe: always clear local auth state even if API call fails.
    clearSession();
    authState.initialized = true;
  }

  return { remoteLogoutSucceeded };
}

function mapAuthError(error) {
  const status = error?.response?.status;
  const data = error?.response?.data || {};
  const fieldErrors = {};

  if (status === 422 && data.errors && typeof data.errors === "object") {
    for (const [field, messages] of Object.entries(data.errors)) {
      if (Array.isArray(messages) && messages.length > 0) {
        fieldErrors[field] = messages[0];
      }
    }
  }

  const message =
    fieldErrors.identifier ||
    fieldErrors.password ||
    data.message ||
    "Unable to sign in. Please verify your credentials and try again.";

  return {
    status,
    message,
    fieldErrors
  };
}

setUnauthorizedHandler(() => {
  debugLog("401 detected by interceptor. Clearing session.");
  clearSession();
  authState.initialized = true;
});

export const authService = {
  state: readonly(authState),
  login,
  logout,
  fetchMe,
  restoreSession,
  isAuthenticated,
  hasRole,
  getRouteByRole,
  clearSession,
  mapAuthError
};
