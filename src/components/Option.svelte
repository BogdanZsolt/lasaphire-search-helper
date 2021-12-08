<script>
  import { fade } from "svelte/transition";
  export let options;
  const num2Str = [
    "zero",
    "one",
    "two",
    "three",
    "four",
    "five",
    "six",
    "seven",
    "eight",
    "nine",
    "ten",
  ];
</script>

{#if options > 1}
  <p in:fade>Select up to {num2Str[options]} options</p>
{:else}
  <p in:fade>Select {num2Str[options]} option</p>
{/if}
