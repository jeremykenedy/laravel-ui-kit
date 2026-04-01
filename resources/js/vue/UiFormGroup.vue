<script setup>
defineProps({ label: String, for: String, hint: String, error: String, required: Boolean })
</script>
<template>
  <div class="mb-4">
    <label v-if="label" :for="$props.for" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ label }}<span v-if="required" class="text-red-500"> *</span></label>
    <slot />
    <p v-if="error" class="mt-1 text-sm text-red-600">{{ error }}</p>
    <p v-else-if="hint" class="mt-1 text-sm text-gray-500">{{ hint }}</p>
  </div>
</template>
