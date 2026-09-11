<template>
  <Teleport to="body">
    <div
      v-if="modelValue"
      class="fixed inset-0 z-50 overflow-y-auto"
      role="dialog"
      aria-modal="true"
      :aria-labelledby="title ? titleId : undefined"
    >
      <div class="flex min-h-screen items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 transition-opacity motion-reduce:transition-none" aria-hidden="true" @click="closeable && close()" />
        <div :class="['relative w-full transform rounded-xl bg-white dark:bg-gray-800 text-left shadow-xl', sizeClass]">
          <div v-if="title || closeable" class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 px-6 py-4">
            <h3 v-if="title" :id="titleId" class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ title }}</h3>
            <button
              v-if="closeable"
              type="button"
              class="ml-auto cursor-pointer rounded text-gray-400 transition-colors hover:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:text-gray-300"
              :aria-label="closeLabel"
              @click="close()"
            >
              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </button>
          </div>
          <div class="px-6 py-4"><slot /></div>
          <div v-if="$slots.footer" class="flex justify-end gap-3 border-t border-gray-200 dark:border-gray-700 px-6 py-4"><slot name="footer" /></div>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { computed, onMounted, onUnmounted, useId } from 'vue'

const props = defineProps({
  modelValue: { type: Boolean, default: false },
  title: { type: String, default: null },
  size: { type: String, default: 'md' },
  closeable: { type: Boolean, default: true },
  closeLabel: { type: String, default: 'Close' },
})

const emit = defineEmits(['update:modelValue'])

const sizes = { sm: 'sm:max-w-sm', md: 'sm:max-w-lg', lg: 'sm:max-w-2xl', xl: 'sm:max-w-4xl' }
const sizeClass = computed(() => sizes[props.size] || sizes.md)
const titleId = `ui-modal-title-${useId()}`

function close() {
  emit('update:modelValue', false)
}

function onKeydown(event) {
  if (event.key === 'Escape' && props.modelValue && props.closeable) {
    close()
  }
}

onMounted(() => document.addEventListener('keydown', onKeydown))
onUnmounted(() => document.removeEventListener('keydown', onKeydown))
</script>
