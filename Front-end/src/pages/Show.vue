<script>
import axios from "axios";

//importo store
import { store } from "../store";

// importo componente form per inviare messaggio al teacher
import ContactTeacherForm from "../components/ContactTeacherForm.vue";

import ReviewForm from "../components/ReviewForm.vue";

import RatingForm from "../components/RatingForm.vue";

import Carousel from '../components/Carousel.vue';
export default {
  name: "Show",

  components: {
    ContactTeacherForm,
    Carousel,
    ReviewForm,
    RatingForm,
  },

  data() {
    return {
      store,
      switchForm: false,
      switchReviewForm: false,
      switchRatingForm: false,
      reviews: [],
    };
  },
  methods: {
    getImageUrl(teacher) {
      // Restituisci direttamente il percorso dell'immagine dell'insegnante
      return `http://localhost:8000/storage/${teacher.image_url}`;
    },
    getCVUrl(teacher) {
      return `http://localhost:8000/storage/${teacher.cv_url}`;
    },

    getReviews() {
      axios
        .get(`http://127.0.0.1:8000/api/v1/review?teacher_id=${store.List.id}`)
        .then((response) => {
          this.reviews = response.data.reviews;
          store.recensioni = response.data.reviews;
          // console.log(response.data.reviews)
        })
        .catch((error) => {
          console.error("Errore durante la richiesta API:", error);
        });

      let data_nascita = document.getElementById('DateBirth');

      // DEBUG
      // console.log(data_nascita)

      var dataNascita = new Date(data_nascita.textContent);


      var dataFormattata = `${dataNascita.getDate()}/${dataNascita.getMonth() + 1}/${dataNascita.getFullYear()}`;


      data_nascita.textContent = dataFormattata;
    },

    getStars(num) {

      const stellePiene = '★'.repeat(num);
      const stelleVuote = '☆'.repeat(5 - num);

      return stellePiene + stelleVuote
    }


  },

  mounted() {

    this.getReviews();
    console.log(store.List);


  },
};
</script>

<template>
  <div v-if="store.view">
    <div class="row p-5 justify-content-center" style="width: 95%; margin:0 auto;">
      <div class="col-12 col-md-5 col-xl-4">
        <div class="card border-success mb-4 left-profile-card">
          <div class="card-body">
            <div class="text-center">
              <div class="img_container">
                <img class="w-100 h-100" :src="getImageUrl(store.List)" alt="" />
              </div>
              <div>
                <div class="d-flex justify-content-center align-items-center mt-2 gap-2">
                  <h2>{{ store.List.user.name }} {{ store.List.user.lastname }}</h2>
                </div>
              </div>
              <div class="d-flex align-items-center justify-content-center mb-2">
                <p>
      <i v-for="(index, i) in 5" :key="i"
         :class="{
           'fas fa-star': i < store.List.average_rating, 
           'far fa-star': i >= store.List.average_rating
         }"></i>
    </p>             </div>
              <p id="teacher">INSEGNANTE</p>
            </div>
            <div class="personal-info mt-4">
              <h3>INFORMAZIONI PERSONALI</h3>
              <ul class="personal-list">
                <li><i class="fas fa-cake-candles "></i><span id="DateBirth">{{ store.List.user.date_of_birth }}</span>
                </li>
                <li><i class="fas fa-map-marker-alt "></i><span class="text_info">{{ store.List.city }}</span></li>
                <li><i class="fas fa-briefcase "></i><span class="text_info">Web Developer</span></li>
                <li><i class="far fa-envelope "></i><span class="text_info">{{ store.List.user.email }}</span></li>
                <li><i class="fas fa-mobile "></i><span class="text_info">{{ store.List.phone_number }}</span></li>
                <li><i class="fas fa-receipt "></i><span class="text_info">{{ store.List.tax_id }}</span></li>
              </ul>
            </div>
          </div>
          <div class="buttons-container d-flex justify-content-center mb-4">
            <button class="btn me-3" :class="!this.switchForm ? 'btn-primary' : 'btn-danger'"
              @click="this.switchForm = !this.switchForm">
              {{ this.switchForm ? "Annulla" : "CONTATTA" }}
            </button>
            <button class="btn" :class="!this.switchReviewForm ? 'btn-success' : 'btn-danger'"
              @click="this.switchReviewForm = !this.switchReviewForm">
              {{ this.switchReviewForm ? "Annulla" : "RECENSISCI" }}
            </button>

          </div>

          <ContactTeacherForm v-if="this.switchForm" />
          <ReviewForm v-if="this.switchReviewForm" />
          <RatingForm v-if="this.switchRatingForm" />
        </div>
      </div> <!-- end col  -->
      <div class="col-12 col-md-7 col-xl-8">
        <div class="card border-success right-profile-card">
          <div class="card-header border-success" style="font-weight: bold;">
            ALTRE INFO
          </div>
          <div class="card-body">
            <h5>BIOGRAFIA</h5>
            <p class="text_wrap" style="font-size: larger;">{{ store.List.biography }}</p>

            <h5>MATERIE</h5>
            <ul>
              <li v-for="subject in store.List.subjects" :key="subject.id" style="font-size: larger;">
                {{ subject.name }}
              </li>
            </ul>

            <h5>MOTTO</h5>
            <p style="font-size: larger;">{{ store.List.motto }}</p>

            <h5>CV</h5>
            <button type="button" class="btn cv btn-info" style="color: aliceblue;"><a
                :class="store.List.cv_url !== '' ? 'd-block' : 'd-none'" :href="getCVUrl(store.List)"
                target="_blank"></a>VEDI CV</button>
          </div>
        </div>
        <div class="col-12">
          <h5 class="mt-4 border-bottom">Recensioni</h5>
          <Carousel />
        </div>
      </div>
    </div> <!-- end row  -->
  </div>

</template>


<style lang="scss">
@use "../styles/show.scss";
</style>
