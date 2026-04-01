<template>
  <component :is="href ? 'a' : 'div'" :href="href" class="block rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6" :class="href ? 'hover:border-gray-300 dark:hover:border-gray-600 transition-colors' : ''">
    <p class="text-3xl font-bold" :class="variantColor">{{ value }}</p>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ label }}</p>
  </component>
</template>
<script setup>
import { computed } from 'vue';
const props = defineProps({ value: String, label: String, variant: { type: String, default: 'default' }, href: String });
const variantColor = computed(() => ({
  primary: 'text-blue-600 dark:text-blue-400', success: 'text-green-600 dark:text-green-400',
  warning: 'text-amber-600 dark:text-amber-400', danger: 'text-red-600 dark:text-red-400',
  default: 'text-gray-900 dark:text-gray-100',
}[props.variant] || 'text-gray-900 dark:text-gray-100'));
</script>
