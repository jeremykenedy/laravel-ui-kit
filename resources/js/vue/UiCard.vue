<template>
  <div :class="['rounded-lg bg-white dark:bg-gray-800 shadow-sm', bordered ? 'border border-gray-200 dark:border-gray-700' : '']">
    <div v-if="title || $slots.header" class="border-b border-gray-200 dark:border-gray-700 p-4 sm:p-6">
      <slot name="header">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ title }}</h3>
        <p v-if="subtitle" class="mt-1 text-sm text-gray-500">{{ subtitle }}</p>
      </slot>
    </div>
    <div class="p-4 sm:p-6"><slot /></div>
    <div v-if="$slots.footer" class="border-t border-gray-200 dark:border-gray-700 p-4 sm:p-6 bg-gray-50 dark:bg-gray-800/50 rounded-b-lg">
      <slot name="footer" />
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: { type: String, default: null },
  subtitle: { type: String, default: null },
  bordered: { type: Boolean, default: true },
})
</script>
