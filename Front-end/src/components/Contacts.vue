<script>
//importo store
import { store } from "../store";

export default {
  name: "Contacts",

  data() {
    return {
      store,
    };
  },

  computed: {
    // numcard() {
    //   return store.CardList.length;
    // },
  },
};
</script>

<template>
  <h1>ciao contact</h1>
</template>

<style lang="scss" scoped>
//Scss relativo alla sola sezione di header
@use "../styles/partials/variables" as *;
</style>
