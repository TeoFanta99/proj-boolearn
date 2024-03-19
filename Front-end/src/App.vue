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
  mounted(){
    const loading= document.getElementById('preloader');
    const container= document.getElementById('main-container');

    // setTimeout(() => {
    //     container.classList.remove('d-none');
    // }, 5000); // 5000 millisecondi = 5 secondi
  }
};
</script>

<template>
  <div class="back_gif">
    <div id="preloader"></div>
  </div>
  <div class="container d-none">
    <AppHeader />
    <router-view></router-view>
    <AppFooter />
  </div>
</template>

<style lang="scss">
@use "./styles/general.scss";
@use "./styles/partials/variables";
#preloader {
  background: url("https://media1.tenor.com/m/_dGu36t3VNEAAAAC/loading-buffering.gif") no-repeat;
  position: fixed;
  z-index: 100;
  width: 100vw; 
  height: 800px; 
  background-size: cover;
  background-position: center;
  transform: translate(-50%, -50%) scale(0.2); 
  top: 50%;
  left: 50%; 

}
.back_gif{
  background-color: #fcfefc;
  position: relative;
  height: 100vh;
  width: 100vw;
}
</style>
