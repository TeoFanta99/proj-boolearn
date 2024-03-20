<script>
export default {
  name: "AppHeader",
};
</script>

<template>
  <header>
    <nav
      class="navbar navbar-expand-lg bg-body-tertiary d-flex justify-content-between h-100"
    >
      <div class=" col-1 d-flex justify-content-start">
        <div class="gap-2 d-lg-flex d-md-none">
          <a href="http://localhost:8000/login" class="d-lg-block d-none"
            >Login</a
          >
          <a href="http://localhost:8000/register" class="d-lg-block d-none"
            >Registrazione</a
          >
        </div>
      </div>
      <div>
        <button
          class="btn d-lg-none col-1"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasRight"
          aria-controls="offcanvasRight"
        >
          Accedi/Registrati
        </button>
      </div>
      <!-- Off-canvas -->
      <div
        class="offcanvas offcanvas-start offcanvas-lg d-lg-none "
        tabindex="-1"
        id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel"
      >
        <div class="offcanvas-header border-bottom border-1">
          Login/Registrazione
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
          ></button>
        </div>
        <div class="offcanvas-body">
          <a
            href="http://localhost:8000/login"
            class="btn btn-primary d-block w-50"
            >Login</a
          >
          <a
            href="http://localhost:8000/register"
            class="btn btn-primary d-block w-50 mt-2"
            >Registrazione</a
          >
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <div class="home">
          <a href="" class="d-block d-lg-none">
            <div
              class="d-lg-flex justify-content-center logo-desktop overflow-hidden"
            >
              <div class="image"></div>

              <!-- <img src="../../public/BL1.svg" alt="LOGO" class="logo-mobile" /> -->
            </div>
            <!-- <span>BOOLEARN</span> -->
          </a>
          <a href="" class="d-none d-lg-block">
            <div
              class="d-lg-flex justify-content-center logo-desktop overflow-hidden"
            >
              <div class="image"></div>
            </div>
          </a>
        </div>
      </div>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarText"
        aria-controls="navbarText"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="col-3 d-flex justify-content-end">
        <div class="collapse navbar-collapse d-lg-none col-3" id="navbarText">
          <ul
            class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-center justify-content-lg-end"
          >
            <li class="nav-item">
              <a class="nav-link text-center" href="#">
                <router-link :to="{ name: 'about' }"> About </router-link>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-center" href="#">
                <router-link :to="{ name: 'faq' }"
                  ><i class="fa-solid fa-house me-2"></i> FAQ</router-link
                >
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-center" href="#">
                <router-link :to="{ name: 'contact' }"
                  ><i class="fa-solid fa-house me-2"></i> Contact</router-link
                >
              </a>
            </li>
          </ul>
        </div>
      </div>

      <!-- <div class="d-none d-md-block link">

                    </div> -->
    </nav>
  </header>
</template>

<style lang="scss" scoped>
@use "../styles/header.scss";
@use "../styles/general.scss";
.logo-desktop {
  width: 200px;
  height: 100px;
}
.image {
  background-image: url("/public/Crop_BooLEARN.svg");
  width: 100%;
  height: 100%;
  background-size: 90%;
  background-position: 200% 0%;
  object-fit: cover;
  background-repeat: no-repeat;
}

header {
  height: 100px;
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  z-index: 99999;
}
#navbarText {
  flex-grow: 0;
}
.no_opacity {
  opacity: 0;
}
@media (min-width: 0px) and (max-width:990px){
  .image{
    background-image: url('../../public/BL1.svg');
    background-position: 100% 50%;
  }
}
</style>
