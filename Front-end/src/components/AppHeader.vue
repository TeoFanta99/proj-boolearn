<script>
export default {
  name: "AppHeader",
};
</script>

<template>
  <header>
    <nav
      class="navbar navbar-expand-lg bg-body-tertiary d-flex justify-content-between"
    >
      <div class="container">
        <div class="user">
          <a
            class=""
            data-bs-toggle="offcanvas"
            href="#offcanvasExample"
            aria-controls="offcanvasExample"
            >User</a
          >
          <div
            class="offcanvas offcanvas-start d-lg-none"
            tabindex="-1"
            id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel"
          >
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                Offcanvas
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
              ></button>
            </div>
            <div class="offcanvas-body">
              <div>
                <a href="http://localhost:8000/login">Login</a>
                <br><br>
                <a href="http://localhost:8000/register">Registrati</a>
              </div>
            </div>
          </div>
        </div>
        <div class="home" >
          <a href="" class="d-block d-lg-none">
            <img src="../../public/BL1.svg" alt="LOGO" class="logo-mobile"/>
            <!-- <span>BOOLEARN</span> -->
          </a>
          <a href="" class="d-none d-lg-block">
            <img src="../../public/Crop_BooLEARN.svg" alt="LOGO DESKTOP" class="logo-desktop"/>
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
              <a
                class="nav-link active text-center"
                aria-current="page"
                href="#"
                >
                <router-link
                  :to="{ path: '/' }"
                  ><i class="fa-solid fa-house me-2 "></i> Home</router-link
               
              ></a>
              
            </li>
            <li class="nav-item ">
              <a class="nav-link  text-center" href="#">
                <router-link :to="{ name: 'about'}">
                  About
                </router-link>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-center" href="#">
                <router-link
                  :to="{ name: 'faq' }"
                  ><i class="fa-solid fa-house me-2 "></i> FAQ</router-link
                >
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-center" href="#">
                <router-link
                  :to="{ name: 'contact' }"
                  ><i class="fa-solid fa-house me-2 "></i> Contact</router-link
                >
              </a>
            </li>
          </ul>
        </div>

        <!-- <div class="d-none d-md-block link">

                    </div> -->
      </div>
    </nav>
  </header>
</template>

<style lang="scss" scoped>
@use "../styles/header.scss";
@use "../styles/general.scss";

#navbarText {
  flex-grow: 0;
}
.no_opacity {
  opacity: 0;
}

</style>
