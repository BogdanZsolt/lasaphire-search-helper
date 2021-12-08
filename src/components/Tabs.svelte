<script>
  // components
  import { getContext, setContext } from "svelte";
  import { writable } from "svelte/store";
  import { fade } from "svelte/transition";
  export let selectedTab = "1";
  // variables
  const titles = [];
  // function
  const updateProps = (value) => {
    selectedTab = value;
  };
  // stores
  let selectedTabStore = writable(selectedTab);
  // context
  setContext("selectedTab", selectedTabStore);
  setContext("tabTitles", {
    registerTab(id, title) {
      titles.push({ id, title });
      titles = titles;
    },
    // updateTitle(id, title) {
    //   const tabIndex = titles.findIndex((title) => title.id === id);
    //   titles[tabIndex].title = title;
    // },
    // unregisterTab(id) {
    //   const tabIndex = titles.findIndex((title) => title.id === id);
    //   if (tabIndex > -1) {
    //     titles.splice(tabIndex, 1);
    //     titles = titles;
    //   }
    // },
  });
  const changeTab = getContext("changeTab");
  // reactivity
  $: $selectedTabStore = selectedTab;
  $: updateProps($selectedTabStore);
</script>

<div transition:fade>
  {#each titles as { id, title }}
    <!-- <button
      class="btn btn-tab"
      class:selected={$selectedTabStore === id}
      on:click={() => {
        $selectedTabStore = id;
      }}
      >{title}</button
    > -->
    <button
      class="btn btn-tab"
      class:selected={$selectedTabStore === id}
      on:click={() => {
        changeTab(id);
      }}>{title}</button
    >
  {/each}
</div>
<slot />
