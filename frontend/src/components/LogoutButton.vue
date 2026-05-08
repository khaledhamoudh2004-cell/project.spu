<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { authService } from "../services/authService";

const router = useRouter();
const isLoading = ref(false);

async function handleLogout() {
  if (isLoading.value) {
    return;
  }

  isLoading.value = true;

  try {
    await authService.logout();
    await router.replace({ name: "login" });
  } finally {
    isLoading.value = false;
  }
}
</script>

<template>
  <button
    type="button"
    :disabled="isLoading"
    class="p-2 rounded-full hover:bg-surface-variant transition-colors cursor-pointer active:opacity-80 disabled:opacity-60 disabled:cursor-not-allowed"
    title="Logout"
    @click="handleLogout"
  >
    <span class="material-symbols-outlined">logout</span>
  </button>
</template>
