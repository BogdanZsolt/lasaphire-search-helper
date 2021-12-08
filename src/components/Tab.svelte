<script>
  import { getContext, onDestroy } from "svelte";
  import { fade } from "svelte/transition";
  export let title;
  export let id;

  let selectedTab = getContext("selectedTab");
  let tabTitles = getContext("tabTitles");

  // $: tabTitles.updateTitle(id, title);

  tabTitles.registerTab(id, title);
  // onDestroy(() => {
  //   tabTitles.unregisterTab(id);
  // });
</script>

<div transition:fade={{ duration: 800 }}>
  {#if $selectedTab === id}
    <slot />
  {/if}
</div>
