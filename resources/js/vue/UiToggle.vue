<template>
  <span class="inline-flex items-center" :class="disabled ? 'opacity-50' : ''">
    <button
      type="button"
      role="switch"
      :aria-checked="modelValue ? 'true' : 'false'"
      :aria-label="label ? undefined : toggleLabel"
      :disabled="disabled"
      class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed motion-reduce:transition-none dark:focus-visible:ring-offset-gray-800"
      :class="modelValue ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600'"
      @click="toggle"
    >
      <span
        class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200 motion-reduce:transition-none"
        :class="modelValue ? 'translate-x-5' : 'translate-x-0'"
      />
    </button>
    <span v-if="label" class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ label }}</span>
  </span>
</template>

<script setup>
const props = defineProps({
  modelValue: { type: Boolean, default: false },
  label: { type: String, default: null },
  disabled: { type: Boolean, default: false },
  toggleLabel: { type: String, default: 'Toggle' },
})

const emit = defineEmits(['update:modelValue'])

function toggle() {
  if (!props.disabled) {
    emit('update:modelValue', !props.modelValue)
  }
}
</script>
