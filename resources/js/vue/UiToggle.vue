<template>
  <label class="inline-flex items-center cursor-pointer">
    <span class="relative inline-flex flex-shrink-0 h-6 w-11 rounded-full border-2 border-transparent transition-colors duration-200" :class="modelValue ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600'" @click="$emit('update:modelValue', !modelValue)" role="switch" :aria-checked="modelValue">
      <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200" :class="modelValue ? 'translate-x-5' : 'translate-x-0'" />
    </span>
    <span v-if="label" class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ label }}</span>
  </label>
</template>

<script setup>
defineProps({
  modelValue: { type: Boolean, default: false },
  label: { type: String, default: null },
  disabled: { type: Boolean, default: false },
})
defineEmits(['update:modelValue'])
</script>
