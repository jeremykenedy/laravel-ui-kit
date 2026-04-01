<script>
  export let variant = 'info'
  export let dismissible = true
  export let title = null
  let visible = true
  const variants = { success: 'bg-green-50 text-green-800 border-green-200', danger: 'bg-red-50 text-red-800 border-red-200', warning: 'bg-amber-50 text-amber-800 border-amber-200', info: 'bg-blue-50 text-blue-800 border-blue-200' }
  $: cls = variants[variant] || variants.info
</script>

{#if visible}
<div class="rounded-lg border p-4 {cls}" role="alert">
  <div class="flex items-start">
    <div class="flex-1">
      {#if title}<h3 class="text-sm font-medium">{title}</h3>{/if}
      <div class={title ? 'mt-1 text-sm opacity-90' : 'text-sm'}><slot /></div>
    </div>
    {#if dismissible}
      <button on:click={() => visible = false} class="ml-3 opacity-60 hover:opacity-100">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
      </button>
    {/if}
  </div>
</div>
{/if}
