<script>
  export let type = 'text'
  export let name = null
  export let id = null
  export let label = null
  export let placeholder = null
  export let hint = null
  export let error = null
  export let value = ''
  export let required = false
  export let disabled = false
  function updateValue(event) {
    const input = event.currentTarget
    value = type === 'number' || type === 'range'
      ? (input.value === '' ? undefined : input.valueAsNumber)
      : input.value
  }
  $: inputId = id || name
  $: hasError = !!error
  $: inputCls = `block w-full rounded-lg border transition-colors duration-150 focus:outline-none focus:ring-2 sm:text-sm dark:bg-gray-800 ${hasError ? 'border-red-300 dark:border-red-600 focus:border-red-500 dark:focus:border-red-400 focus:ring-red-500 dark:focus:ring-red-400' : 'border-gray-300 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 dark:border-gray-600'}`
</script>

<div>
  {#if label}<label for={inputId} class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{label}{#if required}<span class="text-red-500 dark:text-red-400"> *</span>{/if}</label>{/if}
  <input {type} {name} id={inputId} {placeholder} {required} {disabled} {value} on:input={updateValue} class={inputCls} />
  {#if hasError}<p class="mt-1 text-sm text-red-600 dark:text-red-400">{error}</p>{:else if hint}<p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{hint}</p>{/if}
</div>
