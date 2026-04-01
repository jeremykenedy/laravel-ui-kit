<template>
  <div>
    <label v-if="label" :for="id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
      {{ label }}<span v-if="required" class="text-red-500"> *</span>
    </label>
    <input v-bind="{ type, name, id, placeholder, required, disabled, readonly, autocomplete }" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :class="inputClasses" />
    <p v-if="errorMsg" class="mt-1 text-sm text-red-600">{{ errorMsg }}</p>
    <p v-else-if="hint" class="mt-1 text-sm text-gray-500">{{ hint }}</p>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  modelValue: { type: String, default: '' },
  type: { type: String, default: 'text' },
  name: { type: String, default: null },
  id: { type: String, default: null },
  label: { type: String, default: null },
  placeholder: { type: String, default: null },
  hint: { type: String, default: null },
  error: { type: String, default: null },
  required: { type: Boolean, default: false },
  disabled: { type: Boolean, default: false },
  readonly: { type: Boolean, default: false },
  autocomplete: { type: String, default: null },
})

defineEmits(['update:modelValue'])

const errorMsg = computed(() => props.error)

const inputClasses = computed(() => [
  'block w-full rounded-lg border transition-colors duration-150 focus:outline-none focus:ring-2 sm:text-sm dark:bg-gray-800',
  errorMsg.value
    ? 'border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500'
    : 'border-gray-300 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:text-gray-100',
])
</script>
