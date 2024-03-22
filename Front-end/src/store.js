import { reactive } from "vue";

export const store = reactive({
  apiURL: "http://127.0.0.1:8000/api/v1/teachers",

  List: [], // insieme dei teachers
  materie: [], // insieme delle materie (subjects)
  recensioni: [], // insieme delle recensioni (reviews)
  valutazioni: [], // insieme dei voti (ratings)

  view: 0,
  NameSurname: "",
  SearchT: "",
  Email: "",
  Title: "",
  Message: "",

  // Pagina Home.vue
  Subject: "",
  Rating: "",
  Review: "",
});
