<script>
  export let headers = []
  import { createEventDispatcher } from 'svelte'
  const dispatch = createEventDispatcher()
  let sortField = '', sortDir = 'asc'
  function sortBy(h) { sortDir = sortField===h && sortDir==='asc' ? 'desc' : 'asc'; sortField = h; dispatch('sort',{field:h,direction:sortDir}) }
</script>
<div class="overflow-x-auto"><table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
  <thead class="bg-gray-50 dark:bg-gray-800"><tr>{#each headers as h}<th on:click={()=>sortBy(h)} class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">{h}{#if sortField===h}<span class="ml-1">{sortDir==='asc'?'↑':'↓'}</span>{/if}</th>{/each}</tr></thead>
  <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700"><slot/></tbody>
</table></div>
