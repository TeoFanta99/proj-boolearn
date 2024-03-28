<script>
import axios from "axios";

//importo store
import { store } from "../store";

export default {
  name: "Filt_res",

  data() {
    return {
      store,
      throttling: false,
      teachers: [],
      currentPage: 1,
      totalPages: "",
      pageLinks: [],
      loading: true,
      clickCount: 0,
      disableButtons: false,
      buttonEventsDisabled: false,
    };
  },
  methods: {
    getImageUrl(teacher) {
      return `http://localhost:8000/storage/${teacher.image_url}`;
    },

    population() {
      const dataToSend = {
        subject: store.Subject,
        rating: store.Rating,
        review: store.Review,
      };

      axios
        .post(
          `http://127.0.0.1:8000/api/v1/filtered?page=${this.currentPage}`,
          dataToSend
        )
        .then((response) => {
          console.log(response.data);
          this.totalPages = response.data.total_pages;
          this.teachers = response.data.teachers;
          console.log(this.teachers);
          this.currentPage = response.data.current_page;
          if (this.currentPage > this.totalPages) {
            this.currentPage = 1; // Riporta la pagina corrente alla prima pagina
          }
          // console.log(this.currentPage);
          // DEBUG
          // console.log(response.data);
          // console.log(this.teachers);
          // CONFERMO LA FINE DEL CARICAMENTO DEGLI INSEGNANTI
          this.loading = false;
        })
        .catch((error) => {
          if (error.response && error.response.status === 500) {
            // Gestisci l'errore 500
            console.error("Errore interno del server (500)");
          } else {
            // Gestisci altri errori
            console.error("Errore durante la richiesta API:", error);
          }
        });
    },

    // funzione chiamata quando si clicca su un docente
    riempiVet(id) {
      this.teachers.forEach((element) => {
        if (element.id == id) {
          store.List = element;
          localStorage.setItem("teacher", JSON.stringify(store.List));
          store.view = 1;
          localStorage.setItem("view", store.view);
        }
      });
    },
    nextPage() {
      if (
        !this.throttling &&
        !this.disableButtons &&
        this.currentPage < this.totalPages
      ) {
        this.currentPage++;
        this.clickCount++;
        if (this.currentPage === 1) {
          this.clickCount = 0;
          this.disableButtons = false;
        }
        if (this.clickCount >= 5) {
          this.disableButtons = true;
          setTimeout(() => {
            this.disableButtons = false;
            this.clickCount = 0;
          }, 2000);
        }
        this.population();
      }
    },

    prevPage() {
      if (!this.throttling && !this.disableButtons && this.currentPage > 1) {
        this.currentPage--;
        this.clickCount++;
        if (this.currentPage === this.totalPages) {
          this.clickCount = 0;
          this.disableButtons = false;
        }
        if (this.clickCount >= 5) {
          this.disableButtons = true;
          setTimeout(() => {
            this.disableButtons = false;
            this.clickCount = 0;
          }, 1000);
        }
        this.population();
      }
    },

    goToPage(pageNumber) {
      if (
        !this.throttling &&
        !this.disableButtons &&
        pageNumber !== this.currentPage
      ) {
        this.currentPage = pageNumber;
        this.clickCount++;
        if (this.clickCount >= 5) {
          this.disableButtons = true;
          setTimeout(() => {
            this.disableButtons = false;
            this.clickCount = 0;
          }, 1000);
        }
        this.population();
      } else if (
        !this.throttling &&
        !this.disableButtons &&
        pageNumber === this.currentPage
      ) {
        this.clickCount = 0;
      }
    },

    handleButtonDisable() {
      if (this.clickCount >= 5 && !this.disableButtons) {
        this.disableButtons = true;
        setTimeout(() => {
          this.disableButtons = false;
          this.clickCount = 0;
        }, 1000); // Imposta il timeout a 1000 millisecondi (1 secondo)
      }
    },
    disableButtonEvents() {
      this.buttonEventsDisabled = true;
    },
    enableButtonEvents() {
      this.buttonEventsDisabled = false;
    },
  },

  mounted() {
    this.store.valutazioni = JSON.parse(localStorage.getItem("valutazioni"));
    this.store.Subject = localStorage.getItem("materiaID");
    this.population();
  },
  watch: {
    currentPage(newValue, oldValue) {
      this.population();
    },
  },
};
</script>

<template>
  <div class="container">
    <h2>Materia: {{ store.Subject }}</h2>

    <form class="d-flex">
      <div class="col-12 col-md-4 align-self-end pb-2">
        <h4>Filtra per voto</h4>
        <select
          v-model="store.Rating"
          class="form-select w-75"
          id="selected-Rating"
        >
          <option
            v-for="rating in store.valutazioni"
            :key="rating.id"
            :value="rating.id"
          >
            {{ rating.name }}
          </option>
        </select>
      </div>

      <div class="col-12 col-md-4 align-self-end pb-2">
        <h4>Filtra per numero di recensioni</h4>
        <select
          v-model="store.Review"
          class="form-select w-75"
          id="selected-Review"
        >
          <option value="0">Qualsiasi</option>
          <option value="5">Minimo 5 recensioni</option>
          <option value="10">Minimo 10 recensioni</option>
          <option value="12">Minimo 12 recensioni</option>
        </select>
      </div>

      <button
        type="submit"
        form="nameform"
        value="Submit"
        class="btn btn-danger"
        @click="population()"
      >
        ricerca
      </button>
    </form>

    <div v-if="loading">
      <h3>Caricamento...</h3>
    </div>
    <div v-else-if="teachers.length > 0">
      <div class="row mt-4">
        <div
          class="col-12 col-md-4 col-lg-3 p-2"
          v-for="teacher in teachers"
          :key="teacher.id"
        >
          <RouterLink
            :to="{ name: 'show', params: { id: teacher.user.name } }"
            @click="riempiVet(teacher.id)"
            class="text-decoration-none"
          >
            <div class="card pt-3 border-0 shadow">
              <div
                class="d-flex justify-content-center align-items-center img_circle mx-auto height_img_query"
              >
                <img
                  class="w-100 h-100 rounded-circle"
                  :src="getImageUrl(teacher)"
                  alt=""
                />
              </div>
              <div class="card-body">
                <div
                  v-if="teacher.sponsorships.length > 0"
                  class="position-absolute star_sponsor"
                >
                  <i class="fa-solid fa-star"></i>
                </div>

                <h4>{{ teacher.user.name }} {{ teacher.user.lastname }}</h4>
              </div>
            </div>
          </RouterLink>
        </div>
      </div>
    </div>
    <div v-else>
      <h3 class="my-4">Nessun risultato trovato!</h3>
    </div>
    <div class="pagination mt-4">
      <button
        ref="prevButton"
        :disabled="currentPage === 1"
        @click="prevPage"
        @mousedown.prevent="disableButtonEvents"
        @mouseup="enableButtonEvents"
        @touchstart.prevent="disableButtonEvents"
        @touchend="enableButtonEvents"
        class="btn btn-outline-primary"
      >
        Indietro
      </button>
      <button
        v-for="page in totalPages"
        :key="page"
        @click="goToPage(page)"
        :disabled="currentPage === page || disableButtons"
        class="btn btn-primary"
        :class="page == currentPage ? 'text-danger' : ''"
      >
        {{ page }}
      </button>
      <button
        ref="nextButton"
        :disabled="currentPage === totalPages || disableButtons"
        @click="nextPage"
        @mousedown.prevent="disableButtonEvents"
        @mouseup="enableButtonEvents"
        @touchstart.prevent="disableButtonEvents"
        @touchend="enableButtonEvents"
        class="btn"
        :class="{
          'btn-outline-primary': currentPage !== totalPages,
          'btn-outline-secondary': currentPage === totalPages,
        }"
      >
        Avanti
      </button>
    </div>
  </div>
</template>
<style>
/* option {
  width: 100%;
} */
</style>
