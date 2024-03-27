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
      <div class="d-flex gap-2">
        <a
          href="http://localhost:8000/login"
          class="d-lg-block d-none ms-4"
          target="_blank"
          ><i
            class="fa-solid fa-circle-user"
            style="color: #b3b3b3; font-size: 40px"
          ></i
        ></a>
        <a
          href="http://localhost:8000/register"
          class="d-lg-block d-none mt-1 ms-4"
          target="_blank"
          ><i
            class="fa-solid fa-user-plus"
            style="color: rgb(83, 83, 255); font-size: 30px"
          ></i
        ></a>
      </div>
      <div>
        <button
          class="btn d-lg-none"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasRight"
          aria-controls="offcanvasRight"
        >
          <i
            class="fa-solid fa-circle-user"
            style="color: #b3b3b3; font-size: 40px"
          ></i>
        </button>
      </div>
      <!-- Off-canvas -->
      <div
        class="offcanvas offcanvas-start offcanvas-lg d-lg-none"
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
      <div class="home">
        <a href="" class="d-block d-lg-none">
          <img src="../../public/BL1.svg" alt="LOGO" class="logo-mobile" />
          <!-- <span>BOOLEARN</span> -->
        </a>
        <a href="" class="d-none d-lg-block">
          <div class="d-lg-flex justify-content-center logo-desktop">
            <img
              src="../../public/Crop_BooLEARN.svg"
              alt="LOGO DESKTOP"
              class="w-100 h-100 object-fit-contain"
            />
          </div>
        </a>
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
      <div class="collapse navbar-collapse d-lg-none" id="navbarText">
        <ul
          class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-center justify-content-lg-end"
        >
          <li class="nav-item">
            <a class="nav-link text-center" href="#">
              <router-link :to="{ name: 'about' }"
                ><i class="fa-solid fa-people-group fa-lg me-2"></i>IL NOSTRO
                TEAM</router-link
              >
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center" href="#">
              <router-link :to="{ name: 'faq' }"
                ><i class="fa-solid fa-question fa-lg me-2"></i>
                F.A.Q</router-link
              >
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center me-3" href="#">
              <router-link :to="{ name: 'contact' }">
                <i class="fa-solid fa-comments fa-lg me-2"></i> CONTATTACI
              </router-link>
            </a>
          </li>
        </ul>
      </div>

      <!-- <div class="d-none d-md-block link">

                    </div> -->
    </nav>
  </header>
</template>

<style lang="scss" scoped>
@use "../styles/header.scss";
@use "../styles/general.scss";

header {
  height: 100px;
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  z-index: 99999;
}
</style>
