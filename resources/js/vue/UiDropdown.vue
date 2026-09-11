<script setup>
import { onMounted, onUnmounted, ref } from 'vue'

defineProps({
  align: { type: String, default: 'right' },
  toggleLabel: { type: String, default: 'Toggle menu' },
})

const open = ref(false)
const root = ref(null)

function closeOnOutsideClick(event) {
  if (root.value && !root.value.contains(event.target)) {
    open.value = false
  }
}

onMounted(() => document.addEventListener('mousedown', closeOnOutsideClick))
onUnmounted(() => document.removeEventListener('mousedown', closeOnOutsideClick))
</script>
<template>
  <div ref="root" class="relative">
    <div
      role="button"
      tabindex="0"
      :aria-expanded="open ? 'true' : 'false'"
      aria-haspopup="menu"
      :aria-label="toggleLabel"
      @click="open = !open"
      @keydown.enter.prevent="open = !open"
      @keydown.space.prevent="open = !open"
      @keydown.esc="open = false"
    >
      <slot name="trigger" />
    </div>
    <div
      v-if="open"
      class="absolute z-50 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-800"
      :class="align === 'right' ? 'right-0' : 'left-0'"
      role="menu"
    >
      <div class="py-1" @click="open = false"><slot /></div>
    </div>
  </div>
</template>
