<script>
  export let message = ''
  export let variant = 'info'
  export let icon = null
  const cls = {success:'text-green-600',danger:'text-red-600',warning:'text-amber-600',info:'text-blue-600'}
</script>
<div class="text-center py-12">
  {#if icon}<div class="mx-auto mb-4 {cls[variant]||cls.info}"><svg class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>{/if}
  <p class="text-gray-500">{message}</p>
  <div class="mt-4"><slot/></div>
</div>
