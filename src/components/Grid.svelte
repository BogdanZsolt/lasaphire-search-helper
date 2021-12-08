<div class="row">
  <div class="col">
    <slot />
  </div>
</div>

<style global lang="scss">
  .row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -0.9375rem;
    margin-left: -0.9375rem;
  }

  .col {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
  }
</style>
