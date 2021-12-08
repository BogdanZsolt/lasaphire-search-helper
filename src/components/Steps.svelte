<script>
  import { getContext } from "svelte";
  import { fade } from "svelte/transition";
  // variables
  export let stepsNum = 0;
  export let activeQuestion = 1;
  // context
  const setQuestion = getContext("setQuestion");
  const isResultDisabled = getContext("isResult");
</script>

<nav class="step-wrapper">
  <span class="label">Step</span>
  <ul class="step-pager">
    {#each { length: stepsNum } as _, i}
      <li>
        <!-- <a href class:active={activeQuestion === i + 1}>{i + 1}</a> -->
        <button
          type="button"
          class:active={activeQuestion === i + 1}
          class="btn-step"
          disabled={isResultDisabled(i + 1)}
          on:click={() => {
            setQuestion(i + 1);
          }}
          in:fade
        >
          {i + 1}
        </button>
      </li>
    {/each}
  </ul>
</nav>

<style global lang="scss">
  .step-wrapper {
    display: flex;

    .label {
      font-size: 1.15rem;
      margin-right: 10px;
      transform: translateY(-3px);
    }
  }
  .step-pager {
    margin: 0;
    padding: 0;
    display: flex;

    .btn-step {
      display: inline-flex;
      width: 1.25rem;
      height: 1.25rem;
      border-radius: var(--border-radius-round);
      font-size: 1.15rem;
      padding: 0.875rem;
      font-weight: 500;
      margin-right: 5px;
      justify-content: center;
      align-items: center;

      &:disabled {
        color: #afafaf;
      }

      &.active {
        background: var(--primary-color);
      }
    }
  }
</style>
