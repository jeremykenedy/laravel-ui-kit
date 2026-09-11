<template>
  <div ref="root" class="relative">
    <button
      type="button"
      class="inline-flex cursor-pointer items-center rounded-md p-2 text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100"
      :aria-expanded="open ? 'true' : 'false'"
      aria-haspopup="menu"
      :aria-label="toggleLabel"
      @click="open = !open"
    >
      <svg v-if="current === 'light'" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
      <svg v-else-if="current === 'dark'" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
      <svg v-else class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
    </button>

    <div
      v-if="open"
      class="absolute right-0 z-50 mt-1 w-36 rounded-lg bg-white shadow-lg ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700"
      role="menu"
    >
      <div class="py-1">
        <button
          v-for="option in options"
          :key="option.value"
          type="button"
          role="menuitemradio"
          :aria-checked="current === option.value ? 'true' : 'false'"
          class="flex w-full cursor-pointer items-center gap-2 px-4 py-2 text-sm transition-colors hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:bg-gray-700"
          :class="current === option.value ? 'font-medium text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'"
          @click="setTheme(option.value)"
        >
          {{ option.label }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from 'vue'

const props = defineProps({
  initialMode: { type: String, default: 'system' },
  saveUrl: { type: String, default: '' },
  csrfToken: { type: String, default: '' },
  storageKey: { type: String, default: 'theme' },
  toggleLabel: { type: String, default: 'Toggle theme' },
  labels: {
    type: Object,
    default: () => ({ light: 'Light', dark: 'Dark', system: 'System' }),
  },
})

const open = ref(false)
const current = ref(props.initialMode)
const root = ref(null)

const options = ['light', 'dark', 'system'].map((value) => ({ value, label: props.labels[value] }))

function apply(mode) {
  const isDark = mode === 'dark' || (mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)
  document.documentElement.classList.toggle('dark', isDark)
  document.documentElement.style.colorScheme = isDark ? 'dark' : 'light'
}

function setTheme(mode) {
  current.value = mode
  open.value = false

  try {
    localStorage.setItem(props.storageKey, mode)
  } catch (error) {
    // storage unavailable, the theme still applies for this page
  }

  apply(mode)

  if (!props.saveUrl) {
    return
  }

  const token = props.csrfToken || document.querySelector('meta[name=csrf-token]')?.content

  fetch(props.saveUrl, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
      ...(token ? { 'X-CSRF-TOKEN': token } : {}),
    },
    body: JSON.stringify({ dark_mode: mode }),
  }).catch(() => {})
}

function closeOnOutsideClick(event) {
  if (root.value && !root.value.contains(event.target)) {
    open.value = false
  }
}

onMounted(() => {
  try {
    const stored = localStorage.getItem(props.storageKey)
    if (stored) {
      current.value = stored
    }
  } catch (error) {
    // storage unavailable, fall back to the initial mode
  }

  apply(current.value)
  document.addEventListener('mousedown', closeOnOutsideClick)
})

onUnmounted(() => document.removeEventListener('mousedown', closeOnOutsideClick))
</script>
