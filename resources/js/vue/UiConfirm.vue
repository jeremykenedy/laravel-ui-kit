<script setup>
import { ref } from 'vue'
const props = defineProps({ title: { type: String, default: 'Are you sure?' }, message: String, confirmText: { type: String, default: 'Confirm' }, cancelText: { type: String, default: 'Cancel' } })
const emit = defineEmits(['confirmed', 'cancelled'])
const show = ref(false)
const open = () => { show.value = true }
const close = () => { show.value = false; emit('cancelled') }
const confirm = () => { show.value = false; emit('confirmed') }
defineExpose({ open })
</script>
<template>
  <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/50" @click="close"></div>
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-sm w-full p-6">
      <h3 class="text-lg font-medium">{{ title }}</h3>
      <p class="mt-2 text-sm text-gray-500">{{ message }}</p>
      <div class="mt-4 flex justify-end gap-3">
        <button @click="close" class="px-4 py-2 text-sm bg-gray-100 rounded-lg">{{ cancelText }}</button>
        <button @click="confirm" class="px-4 py-2 text-sm text-white bg-red-600 rounded-lg">{{ confirmText }}</button>
      </div>
    </div>
  </div>
</template>
