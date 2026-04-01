<script>
  export let align = 'right'
  let open = false
</script>
<div class="relative">
  <div on:click={()=>open=!open}><slot name="trigger"/></div>
  {#if open}<div on:click|self={()=>open=false} class="absolute z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 {align==='right'?'right-0':'left-0'}">
    <div class="py-1" on:click={()=>open=false}><slot/></div>
  </div>{/if}
</div>
