import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  css: {
    // Includi i file CSS di Slick Carousel
    include: [
      'slick-carousel/slick/slick.css',
      'slick-carousel/slick/slick-theme.css'
    ]
  }
});