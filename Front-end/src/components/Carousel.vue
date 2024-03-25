<template>
  <div class="your_class">
    <div class="slick-slider">
      <div class="slick-slide" v-for="review in store.recensioni" :key="review.id">
        <div class="card h-100 w-100">
          <div class="card-body">
            <h5 class="card-title">{{ review.name }}</h5>
            <p class="card-text">{{ review.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import $ from "jquery";

import "slick-carousel";
import { store } from "../store";
import { onMounted, onUnmounted } from 'vue';

export default {
  data() {
    return {
      store
    };
  },
  mounted() {
    setTimeout(() => {
      $('.your_class .slick-slider').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1
      });
    }, 500);
  },
  // Distruggi Slick Carousel al momento dello smontaggio del componente
  beforeUnmount() {
    $('.your_class .slick-slider').slick('unslick');
  }
};
</script>

<style lang="scss">

.slick-prev::before, .slick-next::before{
  color: black;
}
</style>
