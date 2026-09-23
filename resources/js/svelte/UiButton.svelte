<script>
  export let variant = 'primary'
  export let size = 'md'
  export let type = 'button'
  export let href = null
  export let disabled = false
  export let loading = false
  export let block = false

  const variants = { primary: 'bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-600 dark:text-white dark:hover:bg-blue-500', secondary: 'bg-gray-600 text-white hover:bg-gray-700 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500', success: 'bg-green-600 text-white hover:bg-green-700 dark:bg-green-600 dark:text-white dark:hover:bg-green-500', danger: 'bg-red-600 text-white hover:bg-red-700 dark:bg-red-600 dark:text-white dark:hover:bg-red-500', warning: 'bg-amber-500 text-white hover:bg-amber-600 dark:bg-amber-500 dark:text-white dark:hover:bg-amber-400', info: 'bg-cyan-600 text-white hover:bg-cyan-700 dark:bg-cyan-600 dark:text-white dark:hover:bg-cyan-500' }
  const sizes = { xs: 'px-2 py-1 text-xs', sm: 'px-3 py-1.5 text-sm', md: 'px-4 py-2 text-sm', lg: 'px-5 py-2.5 text-base', xl: 'px-6 py-3 text-lg' }

  $: classes = `inline-flex items-center justify-center font-medium rounded-lg transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800 motion-reduce:transition-none ${sizes[size] || sizes.md} ${variants[variant] || variants.primary} ${block ? 'w-full' : ''} ${disabled || loading ? 'opacity-50 cursor-not-allowed' : ''}`
</script>

{#if href}
  <a class={classes} {...$$restProps} href={disabled || loading ? undefined : href} aria-disabled={disabled || loading ? "true" : undefined} tabindex={disabled || loading ? -1 : $$restProps.tabindex}><slot /></a>
{:else}
  <button {type} class={classes} on:click {...$$restProps} disabled={disabled || loading}>
    {#if loading}
      <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
    {/if}
    <slot />
  </button>
{/if}
