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
                Some text as placeholder. In real life you can have the elements
                you have chosen. Like, text, images, lists, etc.
              </div>
            </div>
          </div>
        </div>
        <div class="home d-lg-none">
          <a href="">
            <img src="../../public/BL1.svg" alt="LOGO" />
            <!-- <span>BOOLEARN</span> -->
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
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link text-center" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-center" href="#">Contacts</a>
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
