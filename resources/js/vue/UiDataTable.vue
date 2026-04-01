<script setup>
import { ref } from 'vue'
const props = defineProps({ headers: { type: Array, default: () => [] } })
const emit = defineEmits(['sort'])
const sortField = ref('')
const sortDir = ref('asc')
function sortBy(h) { sortDir.value = sortField.value === h && sortDir.value === 'asc' ? 'desc' : 'asc'; sortField.value = h; emit('sort', { field: h, direction: sortDir.value }) }
</script>
<template>
  <div class="overflow-x-auto"><table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead class="bg-gray-50 dark:bg-gray-800"><tr><th v-for="h in headers" :key="h" @click="sortBy(h)" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">{{ h }}<span v-if="sortField===h" class="ml-1">{{ sortDir==='asc'?'↑':'↓' }}</span></th></tr></thead>
    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700"><slot /></tbody>
  </table></div>
</template>
