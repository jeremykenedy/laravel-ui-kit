<template>
  <div class="relative">
    <button @click="open = !open" type="button" class="inline-flex items-center p-2 rounded-md text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" title="Toggle theme">
      <svg v-if="current === 'light'" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
      <svg v-else-if="current === 'dark'" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
      <svg v-else class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
    </button>

    <div v-if="open" @click.away="open = false" class="absolute right-0 mt-1 w-36 rounded-lg bg-white dark:bg-gray-800 shadow-lg ring-1 ring-gray-200 dark:ring-gray-700 z-50">
      <div class="py-1">
        <button v-for="option in options" :key="option.value" @click="setTheme(option.value)" type="button" class="flex items-center gap-2 w-full px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-gray-700" :class="current === option.value ? 'font-medium text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'">
          <component :is="option.icon" class="h-4 w-4" />
          {{ option.label }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
  initialMode: { type: String, default: 'system' },
  saveUrl: { type: String, default: '' },
  csrfToken: { type: String, default: '' },
});

const open = ref(false);
const current = ref(props.initialMode);

const options = [
  { value: 'light', label: 'Light', icon: 'SunIcon' },
  { value: 'dark', label: 'Dark', icon: 'MoonIcon' },
  { value: 'system', label: 'System', icon: 'MonitorIcon' },
];

function apply(mode) {
  const isDark = mode === 'dark' || (mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
  document.documentElement.classList.toggle('dark', isDark);
}

function setTheme(mode) {
  current.value = mode;
  localStorage.setItem('theme', mode);
  apply(mode);
  open.value = false;

  if (props.saveUrl) {
    fetch(props.saveUrl, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': props.csrfToken || document.querySelector('meta[name=csrf-token]')?.content,
        'Accept': 'application/json',
      },
      body: JSON.stringify({ dark_mode: mode }),
    }).catch(() => {});
  }
}

onMounted(() => {
  const stored = localStorage.getItem('theme');
  if (stored) current.value = stored;
  apply(current.value);
});
</script>
