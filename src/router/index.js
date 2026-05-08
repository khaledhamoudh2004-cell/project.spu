import { createRouter, createWebHistory } from "vue-router";
import { authService } from "../services/authService";
import LoginView from "../views/Login.vue";
import ManagerOverviewView from "../views/ManagerOverviewView.vue";
import PatientSearchView from "../views/PatientSearchView.vue";
import PharmacistInventoryView from "../views/PharmacistInventoryView.vue";

const isDev = import.meta.env.DEV;

function debugLog(...args) {
  if (isDev) {
    console.log("[ROUTER]", ...args);
  }
}

const routes = [
  {
    path: "/",
    redirect: "/manager-overview"
  },
  {
    path: "/login",
    name: "login",
    component: LoginView,
    meta: {
      guestOnly: true
    }
  },
  {
    path: "/manager-overview",
    name: "manager-overview",
    component: ManagerOverviewView,
    meta: {
      requiresAuth: true,
      roles: ["manager"]
    }
  },
  {
    path: "/patient-search",
    name: "patient-search",
    component: PatientSearchView,
    meta: {
      requiresAuth: true,
      roles: ["patient", "general", "manager", "pharmacist"]
    }
  },
  {
    path: "/pharmacist-inventory",
    name: "pharmacist-inventory",
    component: PharmacistInventoryView,
    meta: {
      requiresAuth: true,
      roles: ["pharmacist", "manager"]
    }
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach(async (to) => {
  debugLog("Navigating", {
    to: to.fullPath,
    requiresAuth: Boolean(to.meta.requiresAuth),
    guestOnly: Boolean(to.meta.guestOnly)
  });

  await authService.restoreSession();

  if (to.meta.requiresAuth && !authService.isAuthenticated()) {
    debugLog("Blocked protected route. Redirecting to /login", {
      redirect: to.fullPath
    });
    return {
      name: "login",
      query: {
        redirect: to.fullPath
      }
    };
  }

  if (to.meta.guestOnly && authService.isAuthenticated()) {
    debugLog("Guest-only route blocked for authenticated user.");
    return authService.getRouteByRole(authService.state.user?.role);
  }

  if (to.meta.roles && !authService.hasRole(to.meta.roles)) {
    debugLog("Role guard redirect", {
      userRole: authService.state.user?.role,
      allowedRoles: to.meta.roles
    });
    return authService.getRouteByRole(authService.state.user?.role);
  }

  return true;
});

export default router;
