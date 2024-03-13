<script>
//importo componenti figli
import Contacts from "./components/Contacts.vue";
import FAQ from "./components/FAQ.vue";

//importo store
import { store } from "./store";

export default {
  components: {
    Contacts,
    FAQ,
  },

  data() {
    return {};
  },
};
</script>

<template>
  <Contacts />
  <FAQ />
</template>

<style lang="scss">
@use "./styles/general.scss";
</style>
