<script>
//importo componenti figli
import Contacts from "./components/Contacts.vue";
import FAQ from "./components/FAQ.vue";
import prova from "./components/prova.vue";
//importo store
import { store } from "./store";

export default {
  components: {
    Contacts,
    FAQ,
    prova,
  },

  data() {
    return {};
  },
};
</script>

<template>
  <!-- <Contacts /> -->
  <!-- <FAQ /> -->
  <prova />
</template>

<style lang="scss">
@use "./styles/general.scss";
</style>
