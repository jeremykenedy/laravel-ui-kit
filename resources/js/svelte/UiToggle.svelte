<script>
  export let checked = false
  export let label = null
  export let disabled = false
  import { createEventDispatcher } from 'svelte'
  const dispatch = createEventDispatcher()
  function toggle() { if (!disabled) { checked = !checked; dispatch('change', checked) } }
</script>

<label class="inline-flex items-center {disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'}">
  <span class="relative inline-flex flex-shrink-0 h-6 w-11 rounded-full border-2 border-transparent transition-colors duration-200 {checked ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600'}" on:click={toggle} role="switch" aria-checked={checked}>
    <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200 {checked ? 'translate-x-5' : 'translate-x-0'}"></span>
  </span>
  {#if label}<span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{label}</span>{/if}
</label>
