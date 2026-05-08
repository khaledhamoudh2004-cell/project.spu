<script setup>
import { reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { authService } from "../services/authService";

const route = useRoute();
const router = useRouter();

const form = reactive({
  identifier: "",
  password: "",
  tokenName: "web"
});

const errors = reactive({
  identifier: "",
  password: "",
  form: ""
});

const isSubmitting = ref(false);
const isDev = import.meta.env.DEV;

function debugLog(...args) {
  if (isDev) {
    console.log("[LOGIN]", ...args);
  }
}

function resetErrors() {
  errors.identifier = "";
  errors.password = "";
  errors.form = "";
}

function validateForm() {
  resetErrors();

  if (!form.identifier.trim()) {
    errors.identifier = "Email or phone is required.";
  }

  if (!form.password) {
    errors.password = "Password is required.";
  }

  if (form.identifier.includes("@")) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(form.identifier.trim())) {
      errors.identifier = "Please enter a valid email address.";
    }
  }

  return !errors.identifier && !errors.password;
}

function resolveRedirectPath() {
  const redirect = route.query.redirect;

  if (typeof redirect === "string" && redirect.startsWith("/")) {
    return redirect;
  }

  return null;
}

async function submitLogin() {
  debugLog("Submit event triggered", {
    identifier: form.identifier,
    hasPassword: Boolean(form.password)
  });

  if (!validateForm()) {
    debugLog("Client validation failed", {
      identifierError: errors.identifier,
      passwordError: errors.password
    });
    return;
  }

  isSubmitting.value = true;
  resetErrors();

  try {
    debugLog("Sending login request...");
    const authData = await authService.login({
      identifier: form.identifier.trim(),
      password: form.password,
      tokenName: form.tokenName
    });
    debugLog("Login succeeded", {
      role: authData?.user?.role || null
    });

    const redirectPath = resolveRedirectPath();

    if (redirectPath) {
      await router.replace(redirectPath);
      return;
    }

    await router.replace(authService.getRouteByRole(authData.user?.role));
  } catch (error) {
    debugLog("Login failed", error);
    const mappedError = authService.mapAuthError(error);
    errors.form = mappedError.message;
    errors.identifier = mappedError.fieldErrors.identifier || "";
    errors.password = mappedError.fieldErrors.password || "";
  } finally {
    isSubmitting.value = false;
  }
}
</script>

<template>
  <main class="min-h-screen bg-gradient-to-b from-surface to-surface-container-low flex items-center justify-center p-4 md:p-8">
    <section class="w-full max-w-md bg-surface-container-lowest border border-outline-variant/30 rounded-xl shadow-[0_18px_40px_rgba(0,60,144,0.12)] p-6 md:p-8">
      <header class="mb-6 text-center">
        <p class="font-headline-sm text-headline-sm text-primary mb-2">PharmaLink</p>
        <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Sign in</h1>
        <p class="font-body-sm text-body-sm text-on-surface-variant">
          Enter your email or phone and password to continue.
        </p>
      </header>

      <form class="space-y-4" @submit.prevent="submitLogin">
        <div>
          <label class="block font-body-sm text-body-sm text-on-surface mb-1" for="identifier">
            Email or Phone
          </label>
          <input
            id="identifier"
            v-model="form.identifier"
            type="text"
            autocomplete="username"
            placeholder="name@example.com or +15551234567"
            class="w-full rounded-lg border border-outline-variant bg-white px-3 py-2.5 text-on-surface font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none"
            :class="{ 'border-error focus:border-error focus:ring-error': errors.identifier }"
          />
          <p v-if="errors.identifier" class="mt-1 text-body-sm text-error">{{ errors.identifier }}</p>
        </div>

        <div>
          <label class="block font-body-sm text-body-sm text-on-surface mb-1" for="password">
            Password
          </label>
          <input
            id="password"
            v-model="form.password"
            type="password"
            autocomplete="current-password"
            placeholder="Enter your password"
            class="w-full rounded-lg border border-outline-variant bg-white px-3 py-2.5 text-on-surface font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none"
            :class="{ 'border-error focus:border-error focus:ring-error': errors.password }"
          />
          <p v-if="errors.password" class="mt-1 text-body-sm text-error">{{ errors.password }}</p>
        </div>

        <p v-if="errors.form" class="rounded-lg bg-error-container text-on-error-container px-3 py-2 text-body-sm">
          {{ errors.form }}
        </p>

        <button
          type="submit"
          class="w-full rounded-lg bg-primary text-on-primary py-2.5 font-headline-sm text-headline-sm hover:bg-primary-container transition-colors disabled:opacity-70 disabled:cursor-not-allowed"
          :disabled="isSubmitting"
        >
          {{ isSubmitting ? "Signing in..." : "Sign in" }}
        </button>
      </form>

      <footer class="mt-6 text-center text-body-sm text-on-surface-variant">
        Protected routes require an active access token.
      </footer>
    </section>
  </main>
</template>
