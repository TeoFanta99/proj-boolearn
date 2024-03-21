<script>
import axios from "axios";

//importo store
import { store } from "../store";

export default {
  name: "Filt_res",

  data() {
    return {
      store,
      teachers: [],
    };
  },
  methods: {
    getImageUrl(teacher) {
      return `http://localhost:8000/storage/${teacher.image_url}`;
    },

    getResults() {
      let subject = store.Subject;
      let rating = store.Rating;
      let review = store.Review;

      // Ottieni i parametri di query
      axios
        .get(
          "http://127.0.0.1:8000/api/v1/result?subject=" +
            subject +
            "&rating=" +
            rating +
            "&review=" +
            review
        )
        .then((response) => {
          this.teachers = response.data.teachers;
          console.log(this.teachers);

          console.log(store.Subject);
        })
        .catch((error) => {
          console.error("Errore durante la richiesta API:", error);
        });

      // console.log("valutazione: " + store.Rating);
      // console.log("materia: " + store.Subject);
      // console.log("Recensioni: almeno " + store.Review);

      // for (let i = 0; i < this.teachers.length - 1; i++) {
      //   let rec = this.teachers[i].reviews;

      //   if (rec.length >= store.Review) {
      //     //console.log(rec);
      //     //return rec;
      //   }
      // }

      // let medie = [];

      // let medieN = [];

      // let ind = 0;
      // let val = 0;

      // let teacher = 0;

      // for (let i = 0; i < this.teachers.length; i++) {
      //   let rec = this.teachers[i].ratings;

      //   let Id_teacher = this.teachers[i].id;

      //   if (Id_teacher != teacher) {
      //     val = 0;

      //     for (let j = 0; j < rec.length; j++) {
      //       let recId = rec[j].id;

      //       val += recId;
      //     }

      //     let FinalResult = val / rec.length;

      //     medie[ind] = FinalResult;

      //     ind++;
      //   }
      // }

      // ind = 0;

      // for (let j = 0; j < medie.length; j++) {
      //   let value = medie[j];

      //   if (value >= store.Rating) {
      //     medieN[ind] = value;

      //     ind++;
      //   }
      // }

      // console.log("medie corrette: " + medieN);
    },

    // funzione chiamata quando si clicca su un docente
    riempiVet(id) {
      this.teachers.forEach((element) => {
        if (element.id == id) {
          store.List = element;
          store.view = 1;
          console.log(store.List);
        }
      });
    },
  },
  mounted() {
    // Chiamata iniziale per caricare i dati
    this.getResults();
  },
};
</script>

<template>
  <div class="container">
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
<style></style>
