<script>
  import { fade } from "svelte/transition";
</script>

<ul class="tab-content-body" in:fade>
  <slot />
</ul>

<style global lang="scss">
  .tab-content-body {
    margin: 0 0 1rem 0;
    display: flex;
    flex-direction: column;
  }
</style>
