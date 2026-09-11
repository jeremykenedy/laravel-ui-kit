<script>
  import { onDestroy, onMount } from 'svelte'

  export let align = 'right'
  export let toggleLabel = 'Toggle menu'
  export let label = 'Options'

  let open = false
  let root
  const menuId = `ui-dropdown-${Math.random().toString(36).slice(2, 10)}`

  function closeOnOutsideClick(event) {
    if (root && !root.contains(event.target)) {
      open = false
    }
  }

  onMount(() => document.addEventListener('mousedown', closeOnOutsideClick))
  onDestroy(() => document.removeEventListener('mousedown', closeOnOutsideClick))
</script>

<div class="relative" bind:this={root}>
  {#if $$slots.trigger}
    <div
      aria-expanded={open}
      aria-haspopup="menu"
      aria-controls={menuId}
      on:click={() => (open = !open)}
    >
      <slot name="trigger" />
    </div>
  {:else}
    <button
      type="button"
      aria-expanded={open}
      aria-haspopup="menu"
      aria-controls={menuId}
      aria-label={toggleLabel}
      on:click={() => (open = !open)}
    >
      {label}
    </button>
  {/if}
  {#if open}
    <div
      id={menuId}
      class="absolute z-50 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-800 {align === 'right' ? 'right-0' : 'left-0'}"
      role="menu"
    >
      <div class="py-1" on:click={() => (open = false)}><slot /></div>
    </div>
  {/if}
</div>
