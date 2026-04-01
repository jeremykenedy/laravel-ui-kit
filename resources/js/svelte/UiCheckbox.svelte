<script>
  export let name = null
  export let label = null
  export let description = null
  export let checked = false
  export let disabled = false
  import { createEventDispatcher } from 'svelte'
  const dispatch = createEventDispatcher()
</script>
<div class="flex items-start">
  <input type="checkbox" id={name} bind:checked {disabled} on:change={()=>dispatch('change',{checked})} class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 mt-0.5" />
  {#if label}<div class="ml-3 text-sm"><label for={name} class="font-medium text-gray-700 dark:text-gray-300">{label}</label>{#if description}<p class="text-gray-500">{description}</p>{/if}</div>{/if}
</div>
