import { reactive } from "vue";

export const store = reactive({
  List: [],
  materie: [],
  apiURL: "http://127.0.0.1:8000/api/v1/teachers",
  view: 0,
  NameSurname: "",
  SearchT: "",
  Email: "",
  Title: "",
  Message: "",
  searchText: "",
});
