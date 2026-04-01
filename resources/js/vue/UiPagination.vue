<script setup>
defineProps({ currentPage: Number, lastPage: Number, total: Number, perPage: { type: Number, default: 15 } })
defineEmits(['page-change'])
</script>
<template>
  <nav v-if="lastPage > 1" class="flex items-center justify-between">
    <p class="text-sm text-gray-700">Showing {{ (currentPage-1)*perPage+1 }} to {{ Math.min(currentPage*perPage, total) }} of {{ total }}</p>
    <div class="flex gap-1">
      <button @click="$emit('page-change', currentPage-1)" :disabled="currentPage<=1" class="px-3 py-1 text-sm rounded border" :class="currentPage<=1?'opacity-50':'hover:bg-gray-50'">Prev</button>
      <button v-for="i in Math.min(5, lastPage)" :key="i" @click="$emit('page-change', i)" class="px-3 py-1 text-sm rounded border" :class="i===currentPage?'bg-blue-600 text-white border-blue-600':'hover:bg-gray-50'">{{ i }}</button>
      <button @click="$emit('page-change', currentPage+1)" :disabled="currentPage>=lastPage" class="px-3 py-1 text-sm rounded border" :class="currentPage>=lastPage?'opacity-50':'hover:bg-gray-50'">Next</button>
    </div>
  </nav>
</template>
