import url from './data'
export default async() => {
 const response = await fetch(`${url}/wp-json/wp/v2/ls_quiz`).catch(error => console.error(error))
 const quizData = await response.json()
 if(quizData.error){
  return null
 } else {
  return quizData
 }
}

