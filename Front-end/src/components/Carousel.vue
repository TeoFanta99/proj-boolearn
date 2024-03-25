<template>
  <div class="your-class">
    <div>Contenuto 1</div>
    <div>Contenuto 2</div>
    <div>Contenuto 3</div>
  </div>
</template>

<script>
import 'slick-carousel/slick/slick.css'; // Importa il file CSS di Slick
import 'slick-carousel/slick/slick-theme.css'; // Importa il file CSS del tema di Slick
import $ from 'jquery'; // Importa jQuery
import 'slick-carousel'; // Importa Slick

export default {
  mounted() {
    $(document).ready(function(){
      $('.your-class').slick({
        // Impostazioni di Slick
        autoplay: true,
        arrows: true,
        // Altre impostazioni...
      });
    });
  }
};
</script>

<style  lang="scss">
.slick-prev::before, .slick-next::before{
  color: black;
}
</style>
