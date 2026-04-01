<script>
  export let value = '0';
  export let label = '';
  export let variant = 'default';
  export let href = null;
  const colors = { primary: 'text-blue-600 dark:text-blue-400', success: 'text-green-600 dark:text-green-400', warning: 'text-amber-600 dark:text-amber-400', danger: 'text-red-600 dark:text-red-400', default: 'text-gray-900 dark:text-gray-100' };
</script>
{#if href}
<a {href} class="block rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 hover:border-gray-300 transition-colors">
  <p class="text-3xl font-bold {colors[variant] || colors.default}">{value}</p>
  <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{label}</p>
</a>
{:else}
<div class="block rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6">
  <p class="text-3xl font-bold {colors[variant] || colors.default}">{value}</p>
  <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{label}</p>
</div>
{/if}
