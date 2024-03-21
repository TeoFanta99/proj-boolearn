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

    FixSubject() {
      // Ottieni i parametri di query
      // axios
      //   .get(
      //     "http://127.0.0.1:8000/api/v1/subject?subjects=" +
      //       params1 +
      //       "?ratings=" +
      //       params2 +
      //       "?"
      //   )
      //   .then((response) => {
      //     this.teachers = response.data.teachers;
      //     console.log(this.teachers);
      //   })
      //   .catch((error) => {
      //     console.error("Errore durante la richiesta API:", error);
      //   });

      console.log("valutazione: " + store.Rating);
      console.log("materia: " + store.Subject);
      console.log("Recensioni: almeno " + store.Review);

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

      for (let i = 0; i < this.teachers.length; i++) {
        let rec = this.teachers[i].ratings;

        let Id_teacher = this.teachers[i].id;

        if (Id_teacher != teacher) {
          val = 0;

          for (let j = 0; j < rec.length; j++) {
            let recId = rec[j].id;

            val += recId;
          }

          let FinalResult = val / rec.length;

          medie[ind] = FinalResult;

          ind++;
        }
      }

      ind = 0;

      for (let j = 0; j < medie.length; j++) {
        let value = medie[j];

        if (value >= store.Rating) {
          medieN[ind] = value;

          ind++;
        }
      }

      this.teachers = this.teachers.filter(teacher => {
        // Verifica se l'insegnante ha tutte le recensioni necessarie
        if (teacher.reviews.length < store.Review) {
          return false; // Salta questo insegnante se non ha abbastanza recensioni
        }

        // Verifica se l'insegnante ha la valutazione richiesta
        // const averageRating = teacher.ratings.reduce((total, rating) => total + rating.value, 0) / teacher.ratings.length;
        // if (averageRating < store.Rating) {
        //   return false; // Salta questo insegnante se la valutazione media è inferiore al rating richiesto
        // }

        // Verifica se l'insegnante insegna la materia selezionata
        if (!teacher.subjects.includes(store.Subject)) {
          return false; // Salta questo insegnante se non insegna la materia selezionata
        }

        // Se l'insegnante ha superato tutti i controlli, includilo nei risultati finali
        return true;
      });

      console.log("Insegnanti che soddisfano tutti e tre i filtri:", this.teachers);



      // Utilizza Vue Router per navigare alla pagina 'filt' con l'ID della materia che mi interessa
      this.$router.push({
        name: "filt",
      });
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
    this.FixSubject();
  },
};
</script>

<template>
  <div class="container">
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
