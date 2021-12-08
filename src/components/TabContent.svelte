<script>
  import { getContext } from "svelte";
  // components
  import Question from "./Question.svelte";
  import Option from "./Option.svelte";
  import Answers from "./Answers.svelte";
  import Steps from "./Steps.svelte";
  import { fade } from "svelte/transition";
  // variable
  export let id;
  export let data;
  export let questions = 0;
  export let selected = [];
  export let btnDisabled = true;
  export let activeQuestion = 1;
  let checked = false;
  // functions
  const nextBtnActive = (value) => {
    return value.length > 0 ? false : true;
    console.log(value);
  };
  const onChangeLimitsHandler = (e, limit) => {
    if (!(selected.length <= limit)) {
      e.target.checked = checked;
      selected.splice(selected.indexOf(e.target.value), 1);
    }
    selected = selected;
  };
  // contexts
  const selectedTab = getContext("selectedTab");
  const nextQuestion = getContext("nextQuestion");
  // reactive
  $: btnDisabled = nextBtnActive(selected);
</script>

{#if $selectedTab === id}
  <div class="tab-content">
    <div class="tab-content-header">
      <Question question={data.question} />
      <Option options={Number.parseInt(data.number_of_choices)} />
    </div>
    <Answers>
      {#each data.answers as { answer, reaction }, id}
        <label for="id" class="answer-wrapper">
          {#if Number.parseInt(data.number_of_choices) === 1}
            <input {id} type="radio" bind:group={selected} value={reaction} />
          {:else}
            <input
              {id}
              type="checkbox"
              bind:group={selected}
              {checked}
              value={reaction}
              on:change={(e) =>
                onChangeLimitsHandler(
                  e,
                  Number.parseInt(data.number_of_choices)
                )}
            />
          {/if}
          {answer}
        </label>
      {/each}
    </Answers>
    <button
      class="btn-alt btn-normal"
      disabled={btnDisabled}
      type="submit"
      on:click={nextQuestion}
    >
      {Number.parseInt(data.questionIndex) === questions ? "complete" : "next"}
    </button>
    <!-- {selected} -->
    <div class="tab-content-footer">
      <Steps stepsNum={questions} bind:activeQuestion />
    </div>
    <slot />
  </div>
{/if}

<style global lang="scss">
  li {
    list-style: none;
  }

  .answer-wrapper {
    display: grid;
    grid-template-columns: 1.5rem auto;
    gap: 0.5rem;
  }

  input[type="radio"],
  input[type="checkbox"] {
    --wekit-appearance: none;
    appearance: none;
    background-color: #fff;
    margin: 0;
    font: inherit;
    color: currentColor;
    width: 2rem;
    height: 1.5rem;
    border: 0.1px solid currentColor;
    border-radius: var(--border-radius-round);
    transform: translateY(-0.075em);
    display: grid;
    place-content: center;
    cursor: pointer;
  }

  input[type="radio"]::before,
  input[type="checkbox"]::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 700;
    content: "\f00c";
    transform: scale(0);
    transition: 120ms transform ease-in-out;
    color: var(--secondary-color);
  }

  input[type="radio"]:checked::before,
  input[type="checkbox"]:checked::before {
    transform: scale(1);
  }
</style>
