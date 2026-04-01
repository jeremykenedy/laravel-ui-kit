<script setup>
import { ref } from 'vue'
defineProps({ align: { type: String, default: 'right' } })
const open = ref(false)
</script>
<template>
  <div class="relative">
    <div @click="open = !open"><slot name="trigger" /></div>
    <div v-if="open" @click.away="open = false" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5" :class="align === 'right' ? 'right-0' : 'left-0'">
      <div class="py-1" @click="open = false"><slot /></div>
    </div>
  </div>
</template>
