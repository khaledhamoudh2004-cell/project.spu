import axios from "axios";
import { getStoredToken } from "./authStorage";

const configuredBaseUrl = import.meta.env.VITE_API_BASE_URL;
const isDev = import.meta.env.DEV;
let unauthorizedHandler = null;

function debugLog(...args) {
  if (isDev) {
    console.log("[API]", ...args);
  }
}

const api = axios.create({
  baseURL: configuredBaseUrl || "/api",
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json"
  }
});

debugLog("Axios initialized", {
  baseURL: api.defaults.baseURL,
  configuredBaseUrl
});

api.interceptors.request.use(
  (config) => {
    const token = getStoredToken();
    const fullUrl = `${config.baseURL || ""}${config.url || ""}`;

    if (token) {
      config.headers = config.headers || {};
      config.headers.Authorization = `Bearer ${token}`;
    }

    debugLog("Request", {
      method: String(config.method || "GET").toUpperCase(),
      url: fullUrl,
      hasToken: Boolean(token)
    });

    return config;
  },
  (error) => {
    debugLog("Request setup error", error);
    return Promise.reject(error);
  }
);

api.interceptors.response.use(
  (response) => {
    const requestUrl = `${response.config?.baseURL || ""}${response.config?.url || ""}`;
    debugLog("Response", {
      status: response.status,
      url: requestUrl
    });
    return response;
  },
  (error) => {
    const status = error?.response?.status;
    const requestUrl = String(error?.config?.url || "");
    const fullUrl = `${error?.config?.baseURL || ""}${requestUrl}`;

    debugLog("Response error", {
      status,
      url: fullUrl,
      message: error?.message,
      data: error?.response?.data
    });

    if (status === 401 && !requestUrl.includes("/auth/login") && typeof unauthorizedHandler === "function") {
      unauthorizedHandler();
    }

    return Promise.reject(error);
  }
);

export function setUnauthorizedHandler(handler) {
  unauthorizedHandler = handler;
}

export default api;
