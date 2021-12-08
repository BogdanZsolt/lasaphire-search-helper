<div class="search-helper-title">
  <slot><!-- optional fallback --></slot>
</div>

<style global lang="scss">
  .search-helper-title {
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      color: var(--primary-lightest-color);
      text-align: center;
    }
    p {
      color: var(--secondary-darker-color);
      font-size: 0.875rem;
      font-weight: 600;
    }
  }
</style>
