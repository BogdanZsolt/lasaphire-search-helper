<script>
  import Product from "./Product.svelte";
  export let products = [];
</script>

<div class="container">
  <ul class="card-wrapper">
    {#each products as product}
      <Product {product} />
    {/each}
  </ul>
</div>

<style global lang="scss">
  .card-wrapper {
    display: flex;
    flex-wrap: wrap;
    padding: 2rem;
    margin: 0 auto;
    justify-content: space-between;
    gap: 1rem;
  }
</style>
