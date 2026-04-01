<script>
  export let title = null
  export let subtitle = null
  export let bordered = true
</script>

<div class="rounded-lg bg-white dark:bg-gray-800 shadow-sm {bordered ? 'border border-gray-200 dark:border-gray-700' : ''}">
  {#if title || $$slots.header}
    <div class="border-b border-gray-200 dark:border-gray-700 p-4 sm:p-6">
      <slot name="header">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{title}</h3>
        {#if subtitle}<p class="mt-1 text-sm text-gray-500">{subtitle}</p>{/if}
      </slot>
    </div>
  {/if}
  <div class="p-4 sm:p-6"><slot /></div>
  {#if $$slots.footer}<div class="border-t border-gray-200 dark:border-gray-700 p-4 sm:p-6 bg-gray-50 dark:bg-gray-800/50 rounded-b-lg"><slot name="footer" /></div>{/if}
</div>
