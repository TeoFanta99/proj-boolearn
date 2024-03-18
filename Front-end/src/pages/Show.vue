<script>
import axios from "axios";

//importo store
import { store } from "../store";

export default {
  name: "Show",

  data() {
    return {
      store,
    };
  },

  mounted() {
    console.log(store.List[0]);

    // Ottieni i parametri di query
    const params = this.$route.query;

    console.log(params);
  },
};
</script>

<template>
  <h1>{{ id }}</h1>
</template>
<style>
.img_circle {
  width: 60%;
}
</style>
