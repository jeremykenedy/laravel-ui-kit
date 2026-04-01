<script>
  export let tabs = []
  export let active = null
  import { createEventDispatcher } from 'svelte'
  const dispatch = createEventDispatcher()
  let activeTab = active || tabs[0] || ''
  function select(t) { activeTab = t; dispatch('tab-change', t) }
</script>
<div>
  <div class="border-b border-gray-200 dark:border-gray-700"><nav class="-mb-px flex space-x-8">
    {#each tabs as tab}<button on:click={()=>select(tab)} type="button" class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium {activeTab===tab?'border-blue-500 text-blue-600':'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'}">{tab}</button>{/each}
  </nav></div>
  <div class="mt-4"><slot {activeTab}/></div>
</div>
