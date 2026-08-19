<template>
  <main class="container my-3">
    <RouterView />
  </main>
</template>

<script setup>
import { useSettings } from './composables/settings';

useSettings();
</script>
