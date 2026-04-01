<template>
  <span :class="['inline-flex items-center font-medium', sizeClasses, variantClasses, rounded ? 'rounded-full' : 'rounded']">
    <span v-if="dot" class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current" />
    <slot />
  </span>
</template>

<script setup>
import { computed } from 'vue'
const props = defineProps({
  variant: { type: String, default: 'primary' },
  size: { type: String, default: 'md' },
  rounded: { type: Boolean, default: false },
  dot: { type: Boolean, default: false },
})
const variants = { primary: 'bg-blue-100 text-blue-800', secondary: 'bg-gray-100 text-gray-800', success: 'bg-green-100 text-green-800', danger: 'bg-red-100 text-red-800', warning: 'bg-amber-100 text-amber-800', info: 'bg-cyan-100 text-cyan-800' }
const sizes = { sm: 'px-2 py-0.5 text-xs', md: 'px-2.5 py-0.5 text-xs', lg: 'px-3 py-1 text-sm' }
const variantClasses = computed(() => variants[props.variant] || variants.primary)
const sizeClasses = computed(() => sizes[props.size] || sizes.md)
</script>
