<script>
  import { fade } from "svelte/transition";
  import { currencySymbol, currencyPos } from "../tools/data";
  export let product = [];
</script>

<div transition:fade class="shProductCard">
  <a href={product.permalink}>
    <div class="image-wrapper">
      <img src={product.image} alt={product.name} />
    </div>
    <div class="shProductCard-content">
      <h5>{product.name}</h5>
      <p>{product.description}</p>
    </div>
    <div class="shProductCard-price">
      <p>
        {#if product.type === "simple"}
          {#if product.salePrice === ""}
            {#if currencyPos === "left"}
              <span>{currencySymbol}{product.regularPrice}</span>
            {:else if currencyPos === "right"}
              <span>{product.regularPrice}{currencySymbol}</span>
            {/if}
          {:else if product.salePrice !== ""}
            <del>
              {#if currencyPos === "left"}
                <span class="discount"
                  >{currencySymbol}{product.regularPrice}</span
                >
              {:else if currencyPos === "right"}
                <span class="discount"
                  >{product.regularPrice}{currencySymbol}</span
                >
              {/if}
            </del>
          {/if}
        {:else if product.type === "variable"}
          <span>
            {#if currencyPos === "left"}
              {currencySymbol}
              {product.salePrice} &ndash; {currencySymbol}
              {product.regularPrice}
            {:else if currencyPos === "right"}
              {product.salePrice}
              {currencySymbol} &ndash; {product.regularPrice}
              {currencySymbol}
            {/if}
          </span>
        {:else if product.type === "external"}
          {#if currencyPos === "left"}
            <span>{currencySymbol} {product.price}</span>
          {:else if currencyPos === "right"}
            <span>{product.price} {currencySymbol}</span>
          {/if}
        {:else if product.type === "grouped"}
          {#if currencyPos === "left"}
            <bdi><span>{currencySymbol} {product.price}</span></bdi>
          {:else if currencyPos === "right"}
            <bdi><span>{product.price} {currencySymbol}</span></bdi>
          {/if}
        {/if}
      </p>
    </div>
  </a>
</div>

<style global lang="scss">
  .shProductCard {
    display: flex;
    flex: 0 1 22%;
    flex-wrap: wrap;
    flex-direction: column;
    align-items: center;
    width: 100%;
    max-height: 21.875rem;
    margin-top: 1.5rem;

    .image-wrapper {
      width: 10.9375rem;
      height: 10.9375rem;
      margin: 0 auto;
      margin-bottom: 1rem;
    }

    a {
      width: 100%;
      height: 100%;
      padding: 1rem;
      border-radius: var(--border-radius-sm);
    }

    a:hover {
      box-shadow: var(--box-shadow-btn);
    }

    img {
      width: 100%;
      height: auto;
    }

    .shProductCard-content {
      p {
        font-size: 0.75rem;
        font-weight: 500;
        line-height: 1.2;
        min-height: 4.375rem;
      }
    }
    .shProductCard-price {
      p {
        font-size: 0.875rem;
        font-weight: 700;
        line-height: 1.2;
        min-height: 1rem;

        .discount {
          color: var(--secondary-lightest-color);
        }
      }
    }
  }
</style>
