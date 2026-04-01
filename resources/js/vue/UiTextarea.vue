<script setup>
defineProps({ name: String, label: String, placeholder: String, rows: { type: Number, default: 4 }, maxlength: Number, showCount: Boolean, required: Boolean, error: String })
const model = defineModel({ default: '' })
</script>
<template>
  <div>
    <label v-if="label" :for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ label }}<span v-if="required" class="text-red-500"> *</span></label>
    <textarea :id="name" v-model="model" :rows="rows" :placeholder="placeholder" :maxlength="maxlength" :required="required" class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 p-2.5 text-sm"></textarea>
    <p v-if="showCount && maxlength" class="mt-1 text-xs text-gray-400">{{ model.length }}/{{ maxlength }}</p>
    <p v-if="error" class="mt-1 text-sm text-red-600">{{ error }}</p>
  </div>
</template>
