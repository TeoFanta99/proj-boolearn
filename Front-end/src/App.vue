<script>
//importo componenti figli
import Contacts from "./components/Contacts.vue";

//importo store
import { store } from "./store";

export default {
  components: {
    Contacts,
  },

  data() {
    return {};
  },
};
</script>

<template>
  <Contacts />
</template>

<style lang="scss">
@use "./styles/general.scss";
</style>
