import { reactive } from "vue";

export const store = reactive({
  List: [],
  apiURL: "https://db.ygoprodeck.com/api/v7/cardinfo.php?num=20&offset=0",
  searchText: "",
  //loading: true,
  //Arc: "archetype",

  ArchList: [],
  apiURL2: "https://db.ygoprodeck.com/api/v7/archetypes.php",
});
