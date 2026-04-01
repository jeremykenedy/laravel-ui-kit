<script>
  export let currentPage = 1
  export let lastPage = 1
  export let total = 0
  export let perPage = 15
  import { createEventDispatcher } from 'svelte'
  const dispatch = createEventDispatcher()
  function go(p) { dispatch('page-change', Math.max(1, Math.min(p, lastPage))) }
  $: pages = Array.from({length: Math.min(5, lastPage)}, (_, i) => i + 1)
</script>
{#if lastPage > 1}
<nav class="flex items-center justify-between">
  <p class="text-sm text-gray-700">Showing {(currentPage-1)*perPage+1} to {Math.min(currentPage*perPage,total)} of {total}</p>
  <div class="flex gap-1">
    <button on:click={()=>go(currentPage-1)} disabled={currentPage<=1} class="px-3 py-1 text-sm rounded border {currentPage<=1?'opacity-50':'hover:bg-gray-50'}">Prev</button>
    {#each pages as i}<button on:click={()=>go(i)} class="px-3 py-1 text-sm rounded border {i===currentPage?'bg-blue-600 text-white border-blue-600':'hover:bg-gray-50'}">{i}</button>{/each}
    <button on:click={()=>go(currentPage+1)} disabled={currentPage>=lastPage} class="px-3 py-1 text-sm rounded border {currentPage>=lastPage?'opacity-50':'hover:bg-gray-50'}">Next</button>
  </div>
</nav>
{/if}
