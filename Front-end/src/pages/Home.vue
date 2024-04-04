<script>
import axios from "axios";
import { store } from "../store";
import Jumbo from "../components/Jumbo.vue";

import Carousel from "../components/Carousel.vue";
export default {
  name: "Home",
  components: {
    Jumbo,
    Carousel,
  },

  data() {
    return {
      store,
      teachers: [],
      SubjectSelect: [],
      teacher: "",
      loading: true,
    };
  },

  methods: {
    getImageUrl(teacher) {
      return `http://localhost:8000/storage/${teacher.image_url}`;
    },

    SearchProf() {
      axios
        .post("http://127.0.0.1:8000/api/v1/result")
        .then((res) => {
          this.teachers = res.data.teachers;
          this.store.materie = res.data.subjects;
          this.store.valutazioni = res.data.ratings;
          console.log(store.materie);
          this.loading = false;
        })
        .catch((error) => {
          console.error("Errore durante la richiesta API:", error);
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

    // funzione chiamata quando si clicca su un docente
    riempiRec() {
      event.preventDefault();
      if (store.Subject != 0) {
      } else {
        store.Subject = "Tutte";
      }
      localStorage.setItem("materiaID", store.Subject);
      localStorage.setItem(
        "valutazioni",
        JSON.stringify(this.store.valutazioni)
      );

      this.$router.push({
        name: "filt",
      });
    },
    hasExpireDate(teacher) {
      if (teacher.sponsorships.length > 0) {
        return true;
      }
    },

    //media recensioni arrotondata alla seconda unità
    media(num) {
      return parseFloat(num).toFixed(2);
    },

    getStars(num) {
      const numStellePiene = Math.ceil(num / 2);
      const numStelleVuote = 5 - numStellePiene;

      const stellePiene = "★".repeat(numStellePiene);
      const stelleVuote = "☆".repeat(numStelleVuote);

      return stellePiene + stelleVuote;
    },
    handleClick(teacher) {
      // Salva i dati nel localStorage
      localStorage.setItem("teacherData", JSON.stringify(teacher));
    },
  },

  watch: {
    SubjectSelect: function (newVal, oldVal) {
      this.SearchProf();
    },

    teachers: {
      deep: true,
      handler(newTeachers) {
        newTeachers.forEach((teacher) => {
          teacher.hasExpireDate = teacher.sponsorships.length > 0;
        });
      },
    },
  },

  mounted() {
    store.Rating = 0;
    store.Review = 0;

    const boh = document.getElementById("boh");
    boh.style.opacity = "0";
    setTimeout(() => {
      boh.style.opacity = "1";
      boh.classList.add("fade-in");

      // Chiamata iniziale per caricare i dati
      this.SearchProf();
    }, 2300);
  },
};
</script>




<template class="bg-light">
  <Jumbo id="boh" />

  <!-- SELECT DELLE MATERIE -->
  <div class="container" style="min-height: 900px">
    <form class="d-flex justify-content-center w-90">
      <div class="me-2" style="width: 100%;">
        <select v-model="store.Subject" class="mt-5 form-select" id="selected-Subject">
          <option disabled value="">Scegli una materia...</option>
          <option value=""><b>Tutte le materie</b></option>
          <option v-for="subject in store.materie" :key="subject.id" :value="subject.name"
            :selected="store.Subject === subject.name ? 'selected' : ''">
            {{ subject.name }}
          </option>
        </select>
      </div>

      <button type="submit" form="nameform" value="Submit" style="width: 10%" class="btn btn-info h-50 mt-5 col-md-2"
        @click="riempiRec()">
        <i class="fas fa-search" style="color: white"></i>
      </button>
    </form>

    <!-- CARD TEACHERS -->
    <div v-if="loading" class="loading-gif">
      <i class="ex-10-icon fas fa-circle-notch"></i>
    </div>
    <div v-else-if="teachers.length > 0" class="row-container">
      <div class="row mt-4 mb-4">
        <div class="col-12 col-md-4 col-xl-3 p-2" v-for="teacher in teachers" :key="teacher.id">
          <RouterLink tag="div" :to="{ name: 'show', params: { id: teacher.user.name } }"
            @click="riempiVet(teacher.id), (store.view = 2)" class="text-decoration-none">
            <div class="card pt-3 border-0 shadow">
              <div class="d-flex justify-content-center align-items-center w-75 mx-auto">
                <img class="w-100 h-100 rounded-circle" :src="getImageUrl(teacher)" alt="" />
              </div>
              <div class="card-body">
                <h4 style="font-weight: bolder;" class="teacher-name">{{ teacher.user.name }} {{ teacher.user.lastname
                  }}</h4>
                <div class="med_rec mt-3">
                  <div>
                    <i class="fas fa-star" style="color: #5353ff;"></i>
                    <span class="ps-2 rating-and-review" style="color: #5353ff;; font-weight: bold;">{{
          media(teacher.average_rating) }}</span>
                    <span class="ms-2 rating-and-review" style="color: #5353ff;">({{ teacher.reviews.length
                      }})</span>
                  </div>
                </div>
              </div>
            </div>
          </RouterLink>
        </div>

        <div v-if="teachers.length==0">
          <h3 class="my-4">NESSUN RISULTATO TROVATO!</h3>
        </div>
      </div>
    </div>
  </div>
</template>



<style lang="scss" scoped>
.loading-gif {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100px;
  width: 100px;
  opacity: 0;
  animation: fadeInOut 1.5s ease-in-out forwards;
}

@keyframes fadeInOut {

  0%,
  100% {
    opacity: 0;
  }

  50% {
    opacity: 1;
  }
}

@keyframes zoomInOut {

  0%,
  100% {
    transform: scale(0.7);
  }

  50% {
    transform: scale(1);
  }
}

.star_sponsor {
  position: absolute;
  top: 10%;
  right: 5%;

  .fa-star {
    color: #5353ff;
  }
}


.card {
  margin: auto;
  font-family: -apple-system, BlinkMacSystemFont, sans-serif;
  background-color: #cbcbcb;
  animation: gradient 7s ease infinite;
  background-size: 400% 400%;
  background-attachment: fixed;
  border-radius: 10px;
  transition: all ease-out 0.2s;

  &:hover {
    transition: all ease-in 0.2s;
    transform: scale(1.05);
    background-color: #ffea74;
  }
}

.med_rec {
  display: flex;
  justify-content: space-between;
  line-height: 1;
}

@media all and (min-width: 768px) and (max-width: 1399px) {
  .teacher-name {
    font-size: 18px;
  }

  .rating-and-review {
    font-size: 16px;
  }
}

.row-container {
  display: flex;
  justify-content: center;

  .row {
    width: 90%;
  }
}

form {
  width: 88%;
  margin: 0 auto;
}
</style>
