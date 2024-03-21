<script>
import axios from "axios";
import { store } from "../store";
import jumbo from "./jumbo.vue";

export default {
  name: "Home",
  components: {
    jumbo,
  },

  data() {
    return {
      store,
      teachers: [],
      subjects: [],
      ratings: [],
      SubjectSelect: [],
      teacher: "",
    };
  },

  methods: {
    getImageUrl(teacher) {
      return `http://localhost:8000/storage/${teacher.image_url}`;
    },

    //funzione chiamata appena la pagina viene caricata dal browser
    SearchProf() {
      let dataToSend = { nome_cognome: this.teacher };

      if (this.SubjectSelect.length > 0) {
        dataToSend.subjects = this.SubjectSelect;
      }

      axios
        .post("http://127.0.0.1:8000/api/v1/hgs", dataToSend)
        .then((response) => {
          this.teachers = response.data.teachers;
          this.subjects = response.data.subjects;
          store.recensioni = response.data.reviews;
          this.ratings = response.data.ratings;
          console.log(this.teachers);
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
          store.view = 1;
        }
      });
    },

    // funzione chiamata quando si clicca su un docente
    riempiRec() {
      for (let i = 0; i < this.teachers.length - 1; i++) {
        let rec = this.teachers[i].reviews;

        if (rec.length >= store.Review) {
          //console.log(rec);
          //return rec;
        }
      }

      let medie = [];

      let medieN = [];

      let ind = 0;
      let val = 0;

      let teacher = 0;
      let FinalResult = 0;

      for (let i = 0; i < this.teachers.length; i++) {
        let rec = this.teachers[i].ratings;

        let Id_teacher = this.teachers[i].id;

        if (Id_teacher != teacher) {
          val = 0;

          for (let j = 0; j < rec.length; j++) {
            let recId = rec[j].id;

            val += recId;
          }

          FinalResult = val / rec.length;

          console.log(FinalResult);

          if (FinalResult >= store.Rating) {
            medieN[ind] = Id_teacher;

            ind++;
          }
        }
      }

      console.log("medie corrette: " + medieN);

      // Utilizza Vue Router per navigare alla pagina 'filt' con l'ID della materia che mi interessa
      this.$router.push({
        name: "filt",
        params: { id: medieN },
      });
    },
  },

  watch: {
    // Osserva le modifiche nella variabile SubjectSelect
    SubjectSelect: function (newVal, oldVal) {
      // Quando SubjectSelect cambia, chiama la funzione SearchProf
      this.SearchProf();
    },
  },

  mounted() {
    //setto a zero tutte le variabili dello store
    store.Subject = 0;
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

    const text = document.querySelector(".sec-text");

    const textLoad = () => {
      setTimeout(() => {
        text.textContent = "HTML";
        text.style.color = "#e5532d";
      }, 0);
      setTimeout(() => {
        text.textContent = "CSS";
        text.style.color = "#254bdd";
      }, 4500);
      setTimeout(() => {
        text.textContent = "JS";
        text.style.color = "#efd81d";
      }, 9000);
    };
    textLoad();
    setInterval(textLoad, 13500);
  },
};
</script>

<template class="bg-light">
  <jumbo id="boh" />

  <div class="container">
    <!-- <div class="row align-items-center">
      <div class="col-12 col-md-4">
        <label for="search">Ricerca</label>
        <input
          class="form-control"
          type="text"
          placeholder="Cerca un insegnante"
          aria-label="Search"
          v-model="store.SearchT"
          @keyup.enter="SearchProf(store.SearchT)"
        />
      </div> -->
    <!-- SELECT -->
    <form class="d-flex">
      <div class="col-12 col-md-4 align-self-end pb-2">
        <h4>Scegli la materia</h4>

        <select
          v-model="store.Subject"
          class="form-select w-25"
          id="selected-Subject"
        >
          <option
            v-for="subject in subjects"
            :key="subject.id"
            :value="subject.id"
          >
            {{ subject.name }}
          </option>
        </select>
      </div>

      <div class="col-12 col-md-4 align-self-end pb-2">
        <h4>Filtra per voto</h4>
        <select
          v-model="store.Rating"
          class="form-select w-25"
          id="selected-Rating"
        >
          <option v-for="rating in ratings" :key="rating.id" :value="rating.id">
            {{ rating.name }}
          </option>
        </select>
      </div>

      <div class="col-12 col-md-4 align-self-end pb-2">
        <h4>Filtra per numero di recensioni</h4>
        <select
          v-model="store.Review"
          class="form-select w-25"
          id="selected-Review"
        >
          >
          <option value="5">min 5</option>
          <option value="10">min 10</option>
          <option value="12">min 12</option>
          <!-- Aggiungi altre condizioni v-if per le altre opzioni -->
        </select>
      </div>

      <button type="submit" form="nameform" value="Submit" @click="riempiRec()">
        ricerca
      </button>
    </form>

    <div v-if="teachers.length > 0">
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
  </div>
</template>
<style>
.img_circle {
  width: 60%;
}
#boh {
  margin-top: 10px;
}
</style>
