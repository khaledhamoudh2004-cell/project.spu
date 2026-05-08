const TOKEN_KEY = import.meta.env.VITE_AUTH_TOKEN_KEY || "pharmalink_auth_token";
const USER_KEY = import.meta.env.VITE_AUTH_USER_KEY || "pharmalink_auth_user";

function parseJson(value) {
  if (!value) {
    return null;
  }

  try {
    return JSON.parse(value);
  } catch {
    return null;
  }
}

export function getStoredToken() {
  return sessionStorage.getItem(TOKEN_KEY);
}

export function getStoredUser() {
  return parseJson(sessionStorage.getItem(USER_KEY));
}

export function saveAuthSession(token, user) {
  sessionStorage.setItem(TOKEN_KEY, token);

  if (user) {
    sessionStorage.setItem(USER_KEY, JSON.stringify(user));
  } else {
    sessionStorage.removeItem(USER_KEY);
  }
}

export function clearAuthSession() {
  sessionStorage.removeItem(TOKEN_KEY);
  sessionStorage.removeItem(USER_KEY);
}
