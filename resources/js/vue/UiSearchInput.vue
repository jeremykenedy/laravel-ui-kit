<script setup>
const model = defineModel({ default: '' })
defineProps({ placeholder: { type: String, default: 'Search...' } })
defineEmits(['search'])
function clear() { model.value = '' }
</script>
<template>
  <div class="relative">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"><svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
    <input type="text" v-model="model" :placeholder="placeholder" @input="$emit('search', model)" class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 pl-10 pr-10 p-2.5 text-sm" />
    <button v-if="model" @click="clear" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">&times;</button>
  </div>
</template>
