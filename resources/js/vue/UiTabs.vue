<script setup>
import { ref } from 'vue'
const props = defineProps({ tabs: { type: Array, default: () => [] }, active: String })
const emit = defineEmits(['tab-change'])
const activeTab = ref(props.active || props.tabs[0] || '')
function select(tab) { activeTab.value = tab; emit('tab-change', tab) }
</script>
<template>
  <div>
    <div class="border-b border-gray-200 dark:border-gray-700"><nav class="-mb-px flex space-x-8">
      <button v-for="tab in tabs" :key="tab" @click="select(tab)" type="button" :class="['whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium', activeTab===tab ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700']">{{ tab }}</button>
    </nav></div>
    <div class="mt-4"><slot :active-tab="activeTab" /></div>
  </div>
</template>
