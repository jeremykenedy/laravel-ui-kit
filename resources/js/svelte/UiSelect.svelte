<script>
  export let name = null
  export let label = null
  export let options = {}
  export let value = ''
  export let placeholder = null
  export let required = false
  export let disabled = false
  export let error = null
</script>
<div>
  {#if label}<label for={name} class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{label}{#if required}<span class="text-red-500 dark:text-red-400"> *</span>{/if}</label>{/if}
  <select id={name} {name} bind:value {required} {disabled} class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-2.5 text-sm">
    {#if placeholder}<option value="">{placeholder}</option>{/if}
    {#each Object.entries(options) as [k, v]}<option value={k}>{v}</option>{/each}
  </select>
  {#if error}<p class="mt-1 text-sm text-red-600 dark:text-red-400">{error}</p>{/if}
</div>
