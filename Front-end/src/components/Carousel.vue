<template>
  <div>
    <div class="mySwiper">
      <swiper slidesPerView="2" :loop="true" :speed="500" :autoplay="{
        delay: 1500,
        disableOnInteraction: false,
        pauseOnMouseEnter: false,
      }" :spaceBetween="10" :navigation="{
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }" :modules="modules" ref="mySwiper" class="swiper-container position-relative">
        <swiper-slide v-for="review in store.recensioni" :key="review.id">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ review.name }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">Subtitle</h6>
              <p class="card-text">{{ review.description }}</p>

            </div>
          </div>
        </swiper-slide>
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
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/swiper-bundle.css';
import 'swiper/components/navigation/navigation.min.css';
import 'swiper/components/pagination/pagination.min.css';
import SwiperCore, { Navigation, Pagination } from 'swiper/core';

SwiperCore.use([Navigation, Pagination]);
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
  mounted() {
    console.log(store.recensioni)
  }
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

.swiper_slide {
  width: 300px;
}

.swiper-container {
  max-width: 100%;
}

.custom-next,
.custom-prev {
  position: absolute;
  top: 45%;
  width: 35px;
  height: 35px;
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
  right: -20px;
}

.custom-prev {
  left: -20px;
}

.swiper-button-next::after,
.swiper-button-prev::after {
  display: none;
}
</style>
