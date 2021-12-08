<script>
  import Products from "./Products.svelte";
  import Loading from "./Loading.svelte";
  import getProductFilter from "../tools/getProductFilter";
  export let result = [];
</script>

{#await getProductFilter(result)}
  <Loading />
{:then products}
  <Products {products} />
{:catch error}
  <p style="color: red;">{error.message}</p>
{/await}
