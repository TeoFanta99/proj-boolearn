<script>
//importo componenti figli
import Contacts from "./components/Contacts.vue";
import FAQ from "./components/FAQ.vue";

//importo store
import { store } from "./store";

import AppFooter from "./components/AppFooter.vue";
import AppHeader from "./components/AppHeader.vue";

export default {
  components: {
    Contacts,
    FAQ,
    AppHeader,
    AppFooter,
  },
  data() {
    return {
      store
    };
  },
};
</script>

<template>
  <AppHeader />
   <router-view></router-view>
   <AppFooter />
</template>

<style lang="scss">
@use "./styles/general.scss";
@use "./styles/partials/variables";
</style>
