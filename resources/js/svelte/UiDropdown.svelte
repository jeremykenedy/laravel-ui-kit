<script>
  import { onDestroy, onMount } from 'svelte'

  export let align = 'right'
  export let toggleLabel = 'Toggle menu'

  let open = false
  let root

  function closeOnOutsideClick(event) {
    if (root && !root.contains(event.target)) {
      open = false
    }
  }

  onMount(() => document.addEventListener('mousedown', closeOnOutsideClick))
  onDestroy(() => document.removeEventListener('mousedown', closeOnOutsideClick))
</script>

<div class="relative" bind:this={root}>
  <div
    role="button"
    tabindex="0"
    aria-expanded={open}
    aria-haspopup="menu"
    aria-label={toggleLabel}
    on:click={() => (open = !open)}
    on:keydown={(event) => { if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); open = !open } }}
  >
    <slot name="trigger" />
  </div>
  {#if open}
    <div
      class="absolute z-50 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-800 {align === 'right' ? 'right-0' : 'left-0'}"
      role="menu"
    >
      <div class="py-1" on:click={() => (open = false)}><slot /></div>
    </div>
  {/if}
</div>
