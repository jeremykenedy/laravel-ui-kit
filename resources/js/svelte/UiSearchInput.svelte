<script>
  export let value = ''
  export let placeholder = 'Search...'
  import { createEventDispatcher } from 'svelte'
  const dispatch = createEventDispatcher()
  function clear() { value = ''; dispatch('search', '') }
  $: dispatch('search', value)
</script>
<div class="relative">
  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"><svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
  <input type="text" bind:value {placeholder} class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 pl-10 pr-10 p-2.5 text-sm" />
  {#if value}<button on:click={clear} class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">&times;</button>{/if}
</div>
