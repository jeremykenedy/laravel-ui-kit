<script>
  export let brand = ''
  export let brandUrl = '/'
  let mobileOpen = false
</script>
<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"><div class="flex justify-between h-16">
    <div class="flex items-center"><a href={brandUrl} class="text-xl font-semibold">{brand}</a></div>
    <div class="hidden sm:flex sm:items-center sm:gap-4"><slot/></div>
    <div class="flex items-center sm:hidden"><button on:click={()=>mobileOpen=!mobileOpen} class="p-2 rounded-md text-gray-400"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d={mobileOpen?'M6 18L18 6M6 6l12 12':'M4 6h16M4 12h16M4 18h16'}/></svg></button></div>
  </div></div>
  {#if mobileOpen}<div class="sm:hidden border-t py-2 px-4"><slot name="mobile"/></div>{/if}
</nav>
