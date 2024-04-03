<script>
import axios from "axios";
import { store } from "../store";
import jumbo from "./jumbo.vue";

import Carousel from "../components/Carousel.vue";
export default {
  name: "Home",
  components: {
    jumbo,
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

    // funzione chiamata appena la pagina viene caricata dal browser
    SearchProf() {
      axios
        .post("http://127.0.0.1:8000/api/v1/result")
        .then((res) => {
          this.teachers = res.data.teachers;
          this.store.materie = res.data.subjects;
          this.store.valutazioni = res.data.ratings;
          // store.List = res.data.teachers2;;
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
      // Esegui qualsiasi operazione necessaria prima di salvare i dati nel localStorage
      // Ad esempio, puoi modificare teacher o accedere ad altri dati

      // Salva i dati nel localStorage
      localStorage.setItem("teacherData", JSON.stringify(teacher));
    },
  },

  watch: {
    // Osserva le modifiche nella variabile SubjectSelect
    SubjectSelect: function (newVal, oldVal) {
      // Quando SubjectSelect cambia, chiama la funzione SearchProf
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
    //setto a zero tutte le variabili dello store
    // console.log(store.List);
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

    // const text = document.querySelector(".sec-text");

    // const textLoad = () => {
    //   setTimeout(() => {
    //     text.textContent = "HTML";
    //     text.style.color = "#e5532d";
    //   }, 0);
    //   setTimeout(() => {
    //     text.textContent = "CSS";
    //     text.style.color = "#254bdd";
    //   }, 4500);
    //   setTimeout(() => {
    //     text.textContent = "JS";
    //     text.style.color = "#efd81d";
    //   }, 9000);
    // };
    // textLoad();
    // setInterval(textLoad, 13500);
  },
};
</script>

<template class="bg-light">
  <jumbo id="boh" />
  <div class="container" style="min-height: 900px">
    <form class="d-flex justify-content-center">
      <div class="me-2">
        <!-- Sezione Select -->
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

    <!-- Sezione icone teachers -->
    <div v-if="loading" class="loading-gif">

      <i class="ex-10-icon fas fa-circle-notch"></i>
    </div>
    <div v-else-if="teachers.length > 0">
      <div class="row mt-4">
        <div class="col-12 col-md-6 col-xl-3 p-2" v-for="teacher in teachers" :key="teacher.id">
          <RouterLink tag="div" :to="{ name: 'show', params: { id: teacher.user.name } }"
            @click="riempiVet(teacher.id), (store.view = 2)" class="text-decoration-none">
            <div class="card pt-3 border-0 shadow on_hover">
              <div class="position-absolute star_sponsor">
                <i class="fa-solid fa-star"></i>
              </div>
              <div class="d-flex justify-content-center align-items-center img_circle mx-auto">
                <img class="w-100 h-100 rounded-circle" :src="getImageUrl(teacher)" alt="" />
              </div>
              <div class="card-body">
                <h4 style="font-weight: bolder;">{{ teacher.user.name }} {{ teacher.user.lastname }}</h4>
                <!-- <span>{{ getStars(store.List[teacher.id].average_rating) }}</span> -->
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

        <div v-if="teachers.length == 0">
          <h3 class="my-4">NESSUN RISULTATO TROVATO!</h3>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="scss">
.loading-gif {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100px;
  /* Regola l'altezza secondo le tue preferenze */
  width: 100px;
  /* Regola la larghezza secondo le tue preferenze */
  opacity: 0;
  animation: fadeInOut 1.5s ease-in-out forwards;
}

.loading-image {
  width: 100%;
  /* Per adattare l'immagine alla grandezza del contenitore */
  animation: zoomInOut 1.5s ease-in-out infinite;
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
  top: 10%;
  right: 5%;

  .fa-star {
    color: #5353ff;
  }
}

.testo-rosso {
  color: red;
}

.img_circle {
  width: 60%;
}

.on_hover {
  transition: all ease-in 0.5s;
  transform: scale(1);

  &:hover {
    transition: all ease-in 0.5s;
    transform: scale(1.08);
  }
}

.med_rec {
  display: flex;
  justify-content: space-between;
  line-height: 1;
}
</style>
