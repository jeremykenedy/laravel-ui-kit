<script>
  export let show = false
  export let title = 'Are you sure?'
  export let message = ''
  export let confirmText = 'Confirm'
  export let cancelText = 'Cancel'
  import { createEventDispatcher } from 'svelte'
  const dispatch = createEventDispatcher()
</script>
{#if show}
<div class="fixed inset-0 z-50 flex items-center justify-center p-4">
  <div class="fixed inset-0 bg-black/50" on:click={()=>dispatch('cancel')}></div>
  <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-sm w-full p-6">
    <h3 class="text-lg font-medium">{title}</h3>
    <p class="mt-2 text-sm text-gray-500">{message}</p>
    <div class="mt-4 flex justify-end gap-3">
      <button on:click={()=>dispatch('cancel')} class="px-4 py-2 text-sm bg-gray-100 rounded-lg">{cancelText}</button>
      <button on:click={()=>dispatch('confirm')} class="px-4 py-2 text-sm text-white bg-red-600 rounded-lg">{confirmText}</button>
    </div>
  </div>
</div>
{/if}
