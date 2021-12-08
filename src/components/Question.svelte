<script>
  import { fade } from "svelte/transition";
  export let question = "";
</script>

<h3 in:fade>{question}</h3>
