<script>
//importo componenti figli
import Contacts from "./components/Contacts.vue";
import FAQ from "./components/FAQ.vue";

//importo store
import { store } from "./store";

import AppFooter from "./components/AppFooter.vue";
import AppHeader from "./components/AppHeader.vue";

import About from "./pages/About.vue";
import Home from "./pages/Home.vue";

export default {
  components: {
    Contacts,
    FAQ,
    AppHeader,
    AppFooter,
    About,
  },
  data() {
    return {
      store,
    };
  },
  mounted() {
    const loading = document.getElementById("loader");
    const container = document.getElementById("main-container");

    setTimeout(() => {
      loading.style.opacity = "0";
      loading.classList.add("fade-in");
    }, 1000); // Fade out del loader dopo 1 secondo
    setTimeout(() => {
      loading.classList.add("d-none");
      container.classList.remove("d-none");
      // Assicura che il contenitore principale sia visibile dopo l'animazione
    }, 1500); // Fade in del contenitore principale dopo 1.5 secondi
  },
};
</script>

<template>
  <div class="back_gif" id="loader">
    <div id="preloader">
      <i class="ex-10-icon fas fa-circle-notch"></i>
    </div>
  </div>
  <div class="d-none" id="main-container">
    <AppHeader />
    <div class="main_views">
      <router-view></router-view>

      <AppFooter />
    </div>
  </div>
</template>

<style lang="scss">
@use "./styles/general.scss";
@use "./styles/partials/variables";

#preloader {

  position: fixed;
  z-index: 100;
  width: 100vw;
  height: 800px;
  top: 50%;
  left: 50%;
}

.ex-10-icon {
  font-size: 60px;
  color: #18e6b7;
}

.ex-10-icon {
  animation: spin 0.5s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(360deg);
  }
}

// .main_views {
//   height: calc(100vh - 90px);
//   /* Altezza della finestra meno l'altezza dell'header */
//   overflow-y: auto;
//   /* Abilita lo scrolling verticale quando necessario */
//   position: relative;
// }

.back_gif {
  position: relative;
  height: 100vh;
  width: 100vw;
}

.fade-in {
  transition: opacity 1s ease-in;
}
</style>
