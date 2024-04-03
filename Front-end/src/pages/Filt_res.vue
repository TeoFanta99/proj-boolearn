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
      totalTeachers: "",
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

          //ottengo numero tatale insegnanti
          this.totalTeachers = response.data.Tot_teachers;

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

    //media recensioni arrotondata alla seconda unità
    media(num) {
      return parseFloat(num).toFixed(2);
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
    <div class="Gen_result d-flex flex-column align-items-center d-md-block pt-5">
      <span class="d-block filt_text w-80 p-2"><b>MATERIA SELEZIONATA: </b>{{ store.Subject }}</span>
      <br>
      <span style="margin-top: 20px" class="d-block filt_text w-80 p-2"><b>RISULTATI TROVATI: </b>{{ totalTeachers
        }}</span>
    </div>

    <div class="mt-5">
      <form class="text-center text-md-start">
        <div class="row row-cols-lg-3 mt-2 mt-md-5 mb-5 justify-content-center">
          <div class="col-12 col-md-4 d-flex flex-column d-md-block align-items-center mt-3 mt-md-0">
            <span class="md-font">MATERIE DISPONIBILI</span>
            <select v-model="store.Subject" class="form-select w-75" id="selected-Subject">
              <option disabled value="">Scegli una materia...</option>
              <option value=""><b>Tutte le materie</b></option>
              <option v-for="subject in store.materie" :key="subject.id" :value="subject.name"
                :selected="store.Subject === subject.name ? 'selected' : ''">
                {{ subject.name }}
              </option>
            </select>
          </div>

          <div class="col-12 col-md-4 d-flex flex-column d-md-block align-items-center mt-3 mt-md-0">
            <span class="md-font">MEDIA VALUTAZIONI</span>
            <select v-model="store.Rating" class="form-select w-75" id="selected-Rating">
              <option disabled value="">Filtra per voto</option>
              <option v-for="rating in store.valutazioni" :key="rating.id" :value="rating.id">
                {{ rating.name }} in su
              </option>
            </select>
          </div>

          <div class="col-12 col-md-4 d-flex flex-column d-md-block align-items-center mt-3 mt-md-0">
            <span class="md-font">N° MIN. RECENSIONI</span>
            <select v-model="store.Review" class="form-select w-75" id="selected-Review">
              <option disabled value="">Filtra per numero di recensioni</option>
              <option value="0">Qualsiasi</option>
              <option value="5">Minimo 5 recensioni</option>
              <option value="10">Minimo 10 recensioni</option>
              <option value="12">Minimo 12 recensioni</option>
            </select>
          </div>
        </div>

        <div class="w-100 d-flex justify-content-center">
          <button type="submit" form="nameform" value="Submit" style="padding: 10px 70px" class="btn h-50 btn-info"
            @click="population()">
            <i class="fas fa-search" style="color: white"></i>
          </button>
        </div>

      </form>

    </div>


    <div v-if="loading">
      <h3>CARICAMENTO...</h3>
    </div>
    <div v-else-if="teachers.length > 0">
      <div class="row mt-4">
        <div class="col-12 col-md-6 col-xl-3 p-2" v-for="teacher in teachers" :key="teacher.id">
          <RouterLink :to="{ name: 'show', params: { id: teacher.user.name } }" @click="riempiVet(teacher.id)"
            class="text-decoration-none">
            <div class="card pt-3 border-0 shadow">
              <div class="d-flex justify-content-center align-items-center img_circle mx-auto">
                <img class="w-100 h-100 rounded-circle" :src="getImageUrl(teacher)" alt="" />
              </div>
              <div class="card-body">
                <div v-if="teacher.sponsorships.length > 0" class="position-absolute star_sponsor">
                  <i class="fa-solid fa-star"></i>
                </div>

                <h4 style="font-weight: bold;">{{ teacher.user.name }} {{ teacher.user.lastname }}</h4>
                <div class="med_rec">
                  <div>
                    <i class="fas fa-star" style="color: #ffd43b"></i>
                    <span class="ps-2" style="color: #ffd43b; font-weight: bold;">{{ media(teacher.average_rating)
                      }}</span>
                  </div>
                  <span style="font-weight: bold; font-size: 15px;">N° RECENSIONI: {{ teacher.reviews.length }}</span>
                </div>
              </div>
            </div>
          </RouterLink>
        </div>
      </div>
    </div>
    <div v-else>
      <h3 class="my-4">NESSUN RISULTATO TROVATO!</h3>
    </div>
    <div class="pagination mt-4 mb-4">
      <button ref="prevButton" :disabled="currentPage === 1" @click="prevPage" @mousedown.prevent="disableButtonEvents"
        @mouseup="enableButtonEvents" @touchstart.prevent="disableButtonEvents" @touchend="enableButtonEvents"
        class="btn pagination-btn border-dark">
        <div class="d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-circle-left" style="font-size: 20px"></i>
        </div>

      </button>
      <button v-for="page in totalPages" :key="page" @click="goToPage(page)"
        :disabled="currentPage === page || disableButtons" class="btn pagination-btn border-dark"
        :class="page == currentPage ? 'selected-text' : ''">
        {{ page }}
      </button>
      <button ref="nextButton" :disabled="currentPage === totalPages || disableButtons" @click="nextPage"
        @mousedown.prevent="disableButtonEvents" @mouseup="enableButtonEvents" @touchstart.prevent="disableButtonEvents"
        @touchend="enableButtonEvents" class="btn pagination-btn border-dark">
        <div class="d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-circle-right" style="font-size: 20px"></i>
        </div>

      </button>
    </div>
  </div>
</template>
<style>
.Gen_result {
  display: flex;
  justify-content: space-between;
  line-height: 1;
}

.med_rec {
  display: flex;
  justify-content: space-between;
  line-height: 1;
}

.pagination-btn {
  background-image: linear-gradient(90deg, #00bf63, #0a73b0);
  margin-right: 10px;
  color: black;
}

.pagination-btn:hover {
  background-image: linear-gradient(90deg, #0a4ab0, #00bf63);
  color: white;
}

.selected-text {
  font-weight: bold;
  color: white;
}

.filt_text {
  margin: 0 auto;
  text-align: center;
  font-size: 35px;
  font-weight: 600;
  color: black;
  box-shadow: 6px 6px 10px -1px rgba(252, 252, 252, 0.863),
    -6px -6px 10px -1px rgba(0, 0, 0, 0.7);
  border-radius: 10px;
  text-shadow: 2px 6px 4px rgba(82, 243, 189, 0.692);
}

.md-font {
  font-size: 20px;
  font-weight: bold;
}

@media all and (min-width: 768px) and (max-width: 991px) {
  .md-font {
    font-size: 15px;
    font-weight: bold;
  }
}
</style>
