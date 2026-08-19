<template>
  <button
    class="btn btn-primary"
    type="button"
    data-bs-toggle="offcanvas"
    data-bs-target="#settingsPanel"
    aria-controls="settingsPanel"
  >
    Settings
  </button>
  
  <div
    class="offcanvas offcanvas-end"
    data-bs-backdrop="static"
    tabindex="-1"
    id="settingsPanel"
    aria-labelledby="settingsPanelTitle"
  >
    <div class="offcanvas-header">
      <h2 class="offcanvas-title" id="settingsPanelTitle">
        Reading settings
      </h2>
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="offcanvas"
        aria-label="Close"
      ></button>
    </div>
    <div class="offcanvas-body">
      <h3 class="text-uppercase small">Font size</h3>
      <div class="d-flex gap-2">
        <button class="btn" :class="fontSize == '14' ? 'btn-primary' : 'btn-light'" @click="setFontSize(14)">A-</button>
        <button class="btn" :class="fontSize == '16' ? 'btn-primary' : 'btn-light'" @click="setFontSize(16)">A</button>
        <button class="btn" :class="fontSize == '18' ? 'btn-primary' : 'btn-light'" @click="setFontSize(18)">A+</button>
      </div>
      <h3 class="text-uppercase small mt-5">Font size</h3>
      <div class="d-flex gap-2">
        <button class="btn" :class="colorTheme == 'light' ? 'btn-primary' : 'btn-light'" @click="setColorTheme('light')">Light</button>
        <button class="btn" :class="colorTheme == 'dark' ? 'btn-primary' : 'btn-light'" @click="setColorTheme('dark')">Dark</button>
      </div>
      <label class="mt-5">
        <h3 class="text-uppercase small">Line spacing</h3>
        <input type="range" class="form-range" min="1" max="2" step="0.1" :value="lineSpacing" @input="setLineSpacing($event.target.value)">
      </label>
    </div>
  </div>
</template>

<script setup>
import { useSettings } from '@/composables/settings';

const { fontSize, colorTheme, lineSpacing, setFontSize, setColorTheme, setLineSpacing } = useSettings();
</script>