<script setup>
defineProps({ name: String, label: String, description: String, checked: Boolean, disabled: Boolean })
defineEmits(['update:checked'])
</script>
<template>
  <div class="flex items-start">
    <input type="checkbox" :id="name" :checked="checked" @change="$emit('update:checked', $event.target.checked)" :disabled="disabled" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 mt-0.5" />
    <div v-if="label" class="ml-3 text-sm"><label :for="name" class="font-medium text-gray-700 dark:text-gray-300">{{ label }}</label><p v-if="description" class="text-gray-500">{{ description }}</p></div>
  </div>
</template>
