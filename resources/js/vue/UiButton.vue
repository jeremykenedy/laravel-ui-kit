<template>
  <component :is="tag" v-bind="computedAttrs" :class="classes" :disabled="disabled || loading">
    <svg v-if="loading" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
    </svg>
    <slot />
  </component>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  variant: { type: String, default: 'primary' },
  size: { type: String, default: 'md' },
  type: { type: String, default: 'button' },
  href: { type: String, default: null },
  disabled: { type: Boolean, default: false },
  loading: { type: Boolean, default: false },
  block: { type: Boolean, default: false },
  outline: { type: Boolean, default: false },
})

const tag = computed(() => props.href ? 'a' : 'button')

const computedAttrs = computed(() => {
  const attrs = {}
  if (props.href) attrs.href = props.href
  else attrs.type = props.type
  return attrs
})

const variantMap = {
  primary: 'bg-blue-600 text-white hover:bg-blue-700',
  secondary: 'bg-gray-600 text-white hover:bg-gray-700',
  success: 'bg-green-600 text-white hover:bg-green-700',
  danger: 'bg-red-600 text-white hover:bg-red-700',
  warning: 'bg-amber-500 text-white hover:bg-amber-600',
  info: 'bg-cyan-600 text-white hover:bg-cyan-700',
}

const sizeMap = {
  xs: 'px-2 py-1 text-xs',
  sm: 'px-3 py-1.5 text-sm',
  md: 'px-4 py-2 text-sm',
  lg: 'px-5 py-2.5 text-base',
  xl: 'px-6 py-3 text-lg',
}

const classes = computed(() => [
  'inline-flex items-center justify-center font-medium rounded-lg transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2',
  sizeMap[props.size] || sizeMap.md,
  variantMap[props.variant] || variantMap.primary,
  props.block ? 'w-full' : '',
  (props.disabled || props.loading) ? 'opacity-50 cursor-not-allowed' : '',
])
</script>
