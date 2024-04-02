<script>
export default {
  name: "AppHeader",
  data() {
    return {
      showOffcanvas: false
    }
  },

  methods: {
    handleLoginClick() {
      if (window.innerWidth <= 992) {
        // Apri l'offcanvas solo su schermi piccoli
        this.showOffcanvas = true;
      } else {
        // Apri la pagina di login su schermi grandi
        window.open("http://localhost:8000/login", "_blank");
      }
    },
    closeOffcanvas() {
      this.showOffcanvas = false; // Chiudi l'offcanvas
    }
  },
};
</script>

<template>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid d-flex justify-content-lg-between justify-content-around">

        <!-- BOTTONI LOGIN E REGISTER -->
        <div class="d-flex gap-2">
          <a @click="handleLoginClick" href="http://localhost:8000/login" class="d-lg-inline-block ms-4" target="_blank"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" style="text-decoration: none;"
            aria-controls="offcanvasRight"><i class="fa-solid fa-circle-user me-2"
              style="color: #b3b3b3; font-size: 40px; vertical-align: sub;"></i><span
              class="d-none d-sm-none d-md-none d-lg-inline-block"
              style="font-size: 20px; color: rgb(83, 83, 255); font-weight: bold;">LOGIN</span>
          </a>
          <a href="http://localhost:8000/register" class="d-lg-inline-block d-none mt-1 ms-4"
            style="text-decoration: none;" target="_blank"><i class="fa-solid fa-user-plus  me-2"
              style="color: rgb(83, 83, 255); font-size: 30px;"></i> <span
              style="font-size: 20px; color: rgb(83, 83, 255); font-weight: bold;">REGISTRATI</span></a>
        </div>

        <!-- OFFCANVAS -->
        <div class=" offcanvas offcanvas-start offcanvas-lg d-lg-none" tabindex="-1" id="offcanvasRight"
          aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            Login/Registrazione
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <a href="http://localhost:8000/login" class="ms_btn d-block w-50">Effettua il Login</a>
            <a href="http://localhost:8000/register" class="ms_btn d-block w-50 mt-2">Registrazione</a>
          </div>
        </div>

        <!-- LOGO HOME -->
        <div class="home">

          <a href="http://localhost:5174/">
            <img src="../../public/BLearn.svg" alt="LOGO" class="logo-mobile" />
            <img src="../../public/BLnew2.svg" alt="LOGO" class="logo-big" />
          </a>
          <!-- <router-link :to="{ name: 'home' }"> -->

          <!-- </router-link> -->
        </div>

        <!-- BOTTONE ESPANDIBILE (HAMBURGER MENU) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- <li class="nav-item">
              <a class="nav-link text-center" href="#">
                <router-link :to="{ name: 'about' }"><i class="fa-solid fa-people-group fa-lg me-2"></i>IL NOSTRO
                  TEAM</router-link>
              </a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link text-center" href="#">
                <router-link :to="{ name: 'faq' }"><i class="fa-solid fa-question fa-lg me-2"></i>
                  <span style="font-size: 20px; color: rgb(83, 83, 255); font-weight: bold;">F.A.Q</span>
                </router-link>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-center me-3" href="#">
                <router-link :to="{ name: 'contact' }">
                  <i class="fa-solid fa-comments fa-lg me-2">
                  </i>
                  <span style="font-size: 20px; color: rgb(83, 83, 255); font-weight: bold;">CONTATTACI</span>
                </router-link>
              </a>
            </li>
          </ul>

        </div>
      </div>
    </nav>
  </header>
</template>

<style lang="scss" scoped>
@use "../styles/header.scss";
@use "../styles/general.scss";


.offcanvas-header {
  background-color: white;
  font-size: 25px;
  color: rgb(83, 83, 255);

}

.offcanvas-body {
  background-color: white;

  .ms_btn {
    background-color: rgb(25, 207, 86);
    color: rgb(83, 83, 255);
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 10px;

    &:hover {
      color: rgb(25, 207, 86);
      background-color: rgb(83, 83, 255);
      transition: color 0.5s ease;
    }
  }
}

.logo-mobile {
  display: block;
  max-width: 80px;
}

/* Stili per l'immagine desktop */
.logo-big {
  display: none;
}

@media screen and (min-width: 638px) {

  /* Modifica i stili per l'immagine desktop quando lo schermo è grande */
  .logo-mobile {
    display: none;
  }

  .logo-big {
    display: block;
  }
}
</style>
