const flattenQuiz = (data) => {
  return data.map((item) => {
    let id = item.id;
    let question = item.title.rendered;
    let number_of_choices = item.number_of_choices;
    let questionIndex = item.questionIndex;
    let categories = [];
    let category = [];
    item.categories.forEach((cat) => {
      category = { name: cat.name, id: cat.term_id };
      categories.push(category);
    });
    let answer = [];
    let answers = [];
    for (let i = 0; i < item.answers.length; i++) {
      answer["answer"] = item.answers[i];
      answer["reaction"] = item.reactions[i];
      answers.push(answer);
      answer = [];
    }
    return {
      id,
      question,
      questionIndex,
      answers,
      categories,
      number_of_choices,
    };
  });
};

const getCategories = (data) => {
  let cats = [];
  data.forEach((item) => {
    item.categories.forEach((cat) => {
      if (cats.indexOf(cat.name) === -1) {
        cats.push(cat.name);
      }
    });
  });
  return cats;
};

const getCategoriesContent = (data) => {
  let cats = getCategories(data);
  let category = [];
  let categories = [];
  let temp = [];
  cats.forEach((cat) => {
    category["name"] = cat;
    data.forEach((item) => {
      item.categories.forEach((a) => {
        if (a.name === cat) temp.push(item);
      });
    });
    category["content"] = temp;
    categories.push(category);
    temp = [];
    category = [];
  });
  // console.log(categories);
  return categories;
};

export const setQuiz = (data) => {
  if (data) {
    data = flattenQuiz(data);
    data = getCategoriesContent(data);
    return data;
  }
};
