<script>
  import { fade } from "svelte/transition";
  export let options;
  const num2Str = [
    "nulla",
    "egy",
    "kettő",
    "három",
    "négy",
    "öt",
    "hat",
    "hét",
    "nyolc",
    "kilenc",
    "tíz",
  ];
  const num2StrEn = [
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
  <p in:fade>Válasszon maximum {num2Str[options]} lehetőséget</p>
{:else}
  <p in:fade>Válasszon {num2Str[options]} lehetőséget</p>
{/if}
