<script>
  import { onMount, setContext } from "svelte";
  import { fly } from "svelte/transition";
  // components
  import Loading from "./components/Loading.svelte";
  import Container from "./components/Container.svelte";
  import Grid from "./components/Grid.svelte";
  import Title from "./components/Title.svelte";
  import Tabs from "./components/Tabs.svelte";
  import Tab from "./components/Tab.svelte";
  import TabContent from "./components/TabContent.svelte";
  import url from "./tools/url";
  import Result from "./components/Result.svelte";
  // data
  import { setQuiz } from "./tools/quiz";
  // variants
  let result = [];
  // let result = [
  //   "dry-or-dehydrated",
  //   ["pigmentation", "drydehydrated", "liftingfirming"],
  //   ["eczema-or-dermatitis", "dryflaky"],
  //   "female",
  // ];
  let products = [];
  let quizData;
  let selectedTab = 0;
  let activeQuestion = 1;
  let questions;
  let selected = [];
  let isShowSearch = true;
  const slide = document.querySelector("#forme .slide");
  // slide.classList.add("hide");
  console.log(selected);
  // functions
  onMount(async () => {
    const response = await fetch(`${url}/wp-json/wp/v2/ls_quiz`);
    quizData = await response.json();
    quizData = setQuiz(quizData);
    questions = quizData[selectedTab].content.length;
  });
  const setQuestion = (qNum) => {
    activeQuestion = qNum;
    selected = result[activeQuestion - 1];
    console.log(selected);
  };
  const nextQuestion = () => {
    if (activeQuestion < questions) {
      result[activeQuestion - 1] = selected;
      activeQuestion += 1;
      selected = [];
      console.log(result);
    } else {
      result[activeQuestion - 1] = selected;
      slide.classList.add("hide");
      console.log(result, "tovabb: product attribute search");
      isShowSearch = false;
    }
  };
  const isResult = (qNum) => {
    let isEmpty = true;
    if (!result[qNum - 1] && activeQuestion !== qNum) {
      isEmpty = true;
    } else {
      isEmpty = false;
    }
    return isEmpty;
  };
  const changeTab = (id) => {
    selectedTab = id;
    selected = [];
    result = [];
    questions = quizData[selectedTab].content.length;
    activeQuestion = 1;
  };
  // context
  setContext("nextQuestion", nextQuestion);
  setContext("setQuestion", setQuestion);
  setContext("isResult", isResult);
  setContext("changeTab", changeTab);
  // selectedTab = getContext("selectedTab");
</script>

{#if quizData === undefined}
  <Loading />
{:else}
  <div id="search-helper">
    {#if isShowSearch}
      <Container>
        <Grid>
          <Title
            ><h1 in:fly={{ x: 100, delay: 1000 }} out:fly={{ x: 100 }}>
              Find My {quizData[selectedTab].name}
            </h1></Title
          >
          <Tabs bind:selectedTab>
            {#each quizData as { name, content }, index}
              <Tab id={index} title={name}>
                {#each content as data}
                  {#if activeQuestion === Number.parseInt(data.questionIndex)}
                    <TabContent
                      id={index}
                      {data}
                      bind:selected
                      bind:questions
                      bind:activeQuestion
                    />
                  {/if}
                {/each}
              </Tab>
            {/each}
          </Tabs>
        </Grid>
      </Container>
    {:else}
      <div class="container">
        <div class="result-wrapper">
          <div class="result-content-header">
            <Title
              ><h1 in:fly={{ x: 100, delay: 1000 }} out:fly={{ x: 100 }}>
                Your {quizData[selectedTab].name} Ritual
              </h1>
              <p>
                All done. Based on your answers your core skin care range is
                Mankind.
              </p>
            </Title>
            <div class="btn-group">
              <button type="button" class="btn-alt btn-normal"
                >Add all Essential Nourishments to my bag</button
              >
              <button type="button" class="btn-alt btn-normal"
                >Send me my personalised ritual</button
              >
            </div>
            <a href={`${url}/for-me`}>
              <i class="fas fa-redo" />
              Restart</a
            >
            <Title
              ><h2 in:fly={{ y: -50, delay: 1000 }}>Essential Nourishment</h2>
              <p class="subtitle">
                We recommend the following products for everyday use. Scroll
                down for more recommendations under Ultimate Nourishment.
              </p>
            </Title>
          </div>
          <Result {result} />
        </div>
      </div>
    {/if}
  </div>
{/if}

<style global lang="scss">
  #forme {
    .slide.slide {
      position: absolute;
    }
  }
  .result-wrapper {
    h1 {
      font-size: 3rem;
      font-weight: 500;
      color: var(--primary-lightest-color);
    }

    h2 {
      display: grid;
      place-content: center;
      font-size: 2.5rem;
      margin-top: 5rem;
      margin-bottom: 1.5rem;
      font-weight: 500;
      color: var(--primary-lightest-color);
      font-family: var(--primary-fonts);
    }
  }
  .result-content-header {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .btn-group {
    display: flex;
    gap: 0.3125rem;
    margin-bottom: 1rem;
  }
</style>
