<script>
  import { createEventDispatcher } from 'svelte'

  export let checked = false
  export let label = null
  export let disabled = false
  export let toggleLabel = 'Toggle'

  const dispatch = createEventDispatcher()
  const labelId = `ui-toggle-label-${Math.random().toString(36).slice(2, 10)}`

  function toggle() {
    if (disabled) {
      return
    }

    checked = !checked
    dispatch('change', checked)
  }
</script>

<span class="inline-flex items-center {disabled ? 'opacity-50' : ''}">
  <button
    type="button"
    role="switch"
    aria-checked={checked}
    aria-labelledby={label ? labelId : undefined}
    aria-label={label ? undefined : toggleLabel}
    {disabled}
    class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed motion-reduce:transition-none dark:focus-visible:ring-offset-gray-800 {checked ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600'}"
    on:click={toggle}
  >
    <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200 motion-reduce:transition-none {checked ? 'translate-x-5' : 'translate-x-0'}"></span>
  </button>
  {#if label}<span id={labelId} class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{label}</span>{/if}
</span>
