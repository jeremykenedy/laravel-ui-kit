<script>
  export let label = null
  export let htmlFor = null
  export let hint = null
  export let error = null
  export let required = false
</script>
<div class="mb-4">
  {#if label}<label for={htmlFor} class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{label}{#if required}<span class="text-red-500"> *</span>{/if}</label>{/if}
  <slot/>
  {#if error}<p class="mt-1 text-sm text-red-600">{error}</p>{:else if hint}<p class="mt-1 text-sm text-gray-500">{hint}</p>{/if}
</div>
