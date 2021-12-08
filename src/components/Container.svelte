<div class="shContainer">
  <slot />
</div>

<style global lang="scss">
  .shContainer {
    margin: 0 auto;
    width: 100%;
    max-width: 46.25rem;
  }
  @media all and (min-width: 36rem) {
    .shContainer {
      max-width: 33.75rem;
    }
  }
  @media all and (min-width: 48rem) {
    .shContainer {
      max-width: 45rem;
    }
  }
  @media all and (min-width: 62rem) {
    .shContainer {
      max-width: 60rem;
    }
  }
  @media all and (min-width: 75rem) {
    .shContainer {
      max-width: 71.25rem;
    }
  }
</style>
