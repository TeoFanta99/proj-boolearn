<template>
  <div>
    <div class="mySwiper">
      <swiper
        slidesPerView="1"
        :loop="true"
        :speed="1500"
        :autoplay="{
          delay: 2500,
          disableOnInteraction: false,
          pauseOnMouseEnter: true,
        }"
        :spaceBetween="10"
        :navigation="{
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }"
        :modules="modules"
        ref="mySwiper"
        class="swiper-container position-relative"
      >
        <swiper-slide > asdasd 1</swiper-slide>
        <swiper-slide > asdaasdadasd23123sd 2</swiper-slide>
        <swiper-slide>asdasdasd 3 </swiper-slide>
        <swiper-slide>sdadsad 4 </swiper-slide>
      </swiper>
      <div class="swiper-button-next custom-next rounded-circle">
        <!-- Replace with your next button icon (Font Awesome example) -->
        <i class="fas fa-chevron-right"></i>
      </div>
      <div class="swiper-button-prev custom-prev rounded-circle">
        <!-- Replace with your prev button icon (Font Awesome example) -->
        <i class="fas fa-chevron-left"></i>
      </div>
    </div>

    <!-- Navigation Buttons -->
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/grid";

import "swiper/css/navigation"; // Import navigation styles
import "bootstrap/dist/css/bootstrap.css"; // Import Bootstrap CSS
import { Navigation } from "swiper/modules";
import { store } from "../store";

export default {
  name: "Carousel",
  components: {
    Swiper,
    SwiperSlide,
  },
  data() {
    return {
      modules: [Navigation],
      store,
    };
  },
};
</script>

<style lang="scss" scoped>
@use "../styles/general.scss" as *;
@use "../styles/partials/variables" as *;

.mySwiper {
  padding: 30px;
  background-color: white;
  position: relative;
}

.swiper-container {
  max-width: 100%; /* Set the desired maximum width for the container */
}

.custom-next,
.custom-prev {
  position: absolute;
  top: 45%;
  width: 35px; /* Set the desired width */
  height: 35px; /* Set the desired height */
  background-color: white;
  color: red;
  cursor: pointer;
  z-index: 10;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 15px;
  &:hover {
    background-color: red;
    color: white;
  }
}

.custom-next {
  right: 50px; /* Adjust the distance from the right as needed */
}

.custom-prev {
  left: 50px; /* Adjust the distance from the left as needed */
}

.swiper-button-next::after,
.swiper-button-prev::after {
  display: none;
}
</style>
