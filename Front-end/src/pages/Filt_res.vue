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
      ratings: [],
      subjects: [],
    };
  },
  methods: {
    getImageUrl(teacher) {
      return `http://localhost:8000/storage/${teacher.image_url}`;
    },

    getResults() {
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
          // console.log(this.teachers);
        })
        .catch((error) => {
          console.error("Errore durante la richiesta API:", error);
        });
    },

    getRatings() {

      // Array che conterrà le somme di tutti i rating di tutti i teacher
      let ratingSums = [];

      // Recupero tutti i teacher
      for (let i = 0; i < this.teachers.length; i++) {
        let teacher = this.teachers[i];
        let ratingSum = 0;

        // Recupero i rating di ogni teacher
        for (let j = 0; j < teacher.ratings.length; j++) {

          // Sommo i valori dei rating di ogni teacher
          ratingSum += teacher.ratings[j].id;
        }

        // Calcolo la media
        let average = ratingSum / teacher.ratings.length;

        // Creo un oggetto che contiene l'id dell'insegnante e la somma dei suoi rating
        let teacherObj = {
          teacherId: teacher.id,
          ratingSum: ratingSum,
          average: average,
        };

        // Aggiungo l'oggetto all'array
        ratingSums.push(teacherObj);

        console.log(teacherObj);
      }
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
    console.log(this.teachers);
  },
};
</script>

<template>
  <div class="container">

    <button type="submit" form="nameform" value="Submit" @click="getRatings()">
      calcola
    </button>

    <div v-if="teachers.length > 0">
      <div class="row mt-4">
        <div class="col-12 col-md-4 col-lg-3 p-2" v-for="teacher in teachers" :key="teacher.id">
          <RouterLink :to="{ name: 'show', params: { id: teacher.user.name } }" @click="riempiVet(teacher.id)"
            class="text-decoration-none">
            <div class="card pt-3 border-0 shadow">
              <div class="d-flex justify-content-center align-items-center img_circle mx-auto height_img_query">
                <img class="w-100 h-100 rounded-circle" :src="getImageUrl(teacher)" alt="" />
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
