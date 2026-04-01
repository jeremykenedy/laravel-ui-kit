<script>
  export let name
  export let size = 'md'
  const sizes = {xs:'h-3 w-3',sm:'h-4 w-4',md:'h-5 w-5',lg:'h-6 w-6',xl:'h-8 w-8'}
</script>
<i class="{name} {sizes[size]||sizes.md}"></i>
