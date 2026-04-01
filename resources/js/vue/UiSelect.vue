<script setup>
defineProps({ name: String, label: String, options: { type: [Object, Array], default: () => ({}) }, placeholder: String, required: Boolean, disabled: Boolean, error: String })
const model = defineModel()
</script>
<template>
  <div>
    <label v-if="label" :for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ label }}<span v-if="required" class="text-red-500"> *</span></label>
    <select :id="name" v-model="model" :required="required" :disabled="disabled" class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 p-2.5 text-sm">
      <option v-if="placeholder" value="">{{ placeholder }}</option>
      <option v-for="(v, k) in options" :key="k" :value="k">{{ v }}</option>
    </select>
    <p v-if="error" class="mt-1 text-sm text-red-600">{{ error }}</p>
  </div>
</template>
