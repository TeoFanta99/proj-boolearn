import { reactive } from "vue";

export const store = reactive({
  List: [],
<<<<<<< Updated upstream
  apiURL: "https://db.ygoprodeck.com/api/v7/cardinfo.php?num=20&offset=0",
=======
  apiURL: "http://127.0.0.1:8000/api/v1/teachers",
  apiURL1: "http://127.0.0.1:8000/api/v1/subjects",
  view: 0,
>>>>>>> Stashed changes
  NameSurname: "",
  Email: "",
  Title: "",
  Message: "",

  ArchList: [],
  apiURL2: "https://db.ygoprodeck.com/api/v7/archetypes.php",
});
