<script>
  export let name = null
  export let label = null
  export let value = ''
  export let placeholder = null
  export let rows = 4
  export let maxlength = null
  export let showCount = false
  export let required = false
  export let error = null
</script>
<div>
  {#if label}<label for={name} class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{label}{#if required}<span class="text-red-500"> *</span>{/if}</label>{/if}
  <textarea id={name} bind:value {rows} {placeholder} maxlength={maxlength} {required} class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 p-2.5 text-sm"></textarea>
  {#if showCount && maxlength}<p class="mt-1 text-xs text-gray-400">{value.length}/{maxlength}</p>{/if}
  {#if error}<p class="mt-1 text-sm text-red-600">{error}</p>{/if}
</div>
