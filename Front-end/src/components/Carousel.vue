<template>
  <div class="your_class">
    <div class="slick-slider" style="display: flex; flex-wrap: wrap">
      <div
        class="slick-slide"
        v-for="review in store.recensioni"
        :key="review.id"
        style="flex: 0 0 calc(50% - 15px); margin-right: 15px"
      >
        <div class="card h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-0">{{ review.name }}</h5>
            <p class="card-text">{{ review.description }}</p>
            <p class="card-text">{{ review.date_of_review }}</p>
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
import { onMounted, onUnmounted } from "vue";

export default {
  data() {
    return {
      store,
    };
  },
  mounted() {
    setTimeout(() => {
      $(".your_class .slick-slider").slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
      });
    }, 500);
  },
  // Distruggi Slick Carousel al momento dello smontaggio del componente
  beforeUnmount() {
    $(".your_class .slick-slider").slick("unslick");
  },
};
</script>

<style lang="scss">
.your_class {
  .slick-slider {
    // display: flex; // Rimuovi Flexbox qui
    // flex-wrap: nowrap; // Rimuovi Flexbox qui
    margin: 0 auto; // Centra il carosello
  }

  .slick-slide {
    // Flexbox non è più necessario qui
    // flex: 0 0 auto;
    // margin-right: 15px;
    height: 200px; // Altezza fissa delle card
  }
}

.slick-prev::before,
.slick-next::before {
  color: black;
}
</style>
