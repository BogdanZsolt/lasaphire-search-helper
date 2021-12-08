<script>
</script>

<div class="modal-container">
  <div class="modal-content">
    <slot><!-- optional fallback --></slot>
  </div>
</div>

<style global>
  .modal-container {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(155, 155, 155, 0.3);
    backdrop-filter: blur(2px);
    z-index: 2;
  }
  .modal-content {
    background: transparent;
    width: 85vw;
    max-width: 56.25rem;
    margin: 0 auto;
    margin-top: 10rem;
    padding: 3rem;
    border: none;
    position: relative;
  }
</style>
