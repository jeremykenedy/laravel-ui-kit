<script>
  export let name = 'password'
  export let label = null
  export let error = null
  export let required = false
  export let autocomplete = 'new-password'
  export let value = ''
  let show = false
</script>
<div>
  {#if label}<label for={name} class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{label}{#if required}<span class="text-red-500"> *</span>{/if}</label>{/if}
  <div class="relative">
    <input type={show?'text':'password'} id={name} bind:value {required} {autocomplete} class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 pr-10 p-2.5 text-sm focus:border-blue-500 focus:ring-blue-500" />
    <button type="button" on:click={()=>show=!show} class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
      <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">{#if show}<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M3 3l18 18"/>{:else}<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>{/if}</svg>
    </button>
  </div>
  {#if error}<p class="mt-1 text-sm text-red-600">{error}</p>{/if}
</div>
