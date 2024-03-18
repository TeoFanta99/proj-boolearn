<script>
import axios from "axios";
import { RouterLink } from "vue-router";

//importo store
import { store } from "../store";

export default {
  name: "Home",

  data() {
    return {
      store,
      teachers: [],
      subjects: [],
      SubjectSelect:[],
      teacher: "",
    };
  },

  methods: {
    getImageUrl(teacher) {
      // Restituisci direttamente il percorso dell'immagine dell'insegnante
      return `http://localhost:8000/storage/${teacher.image_url}`;
    },
    handleCheckboxClick(subject) {
    // Verifica se il subject è già presente in selectedSubjects
    if (!this.selectedSubjects.includes(subject)) {
      // Se non presente, aggiungi il subject a selectedSubjects
      this.selectedSubjects.push(subject);
    } else {
      // Se presente, rimuovi il subject da selectedSubjects
      const index = this.selectedSubjects.indexOf(subject);
      if (index !== -1) {
        this.selectedSubjects.splice(index, 1);
      }
    }
  },
    SearchProf(teacher) {
      axios
        .post("http://127.0.0.1:8000/api/v1/hgs", {
          nome_cognome: teacher,
        })
        .then((response) => {
          // console.log(response.data.teachers);
          this.teachers = response.data.teachers;

          this.teachers.forEach((teacher) => {
            teacher.subjects.forEach((subject) => {
              if (!this.subjects.includes(subject.name)) {
                this.subjects.push(subject.name);
              }
            });
          });
        })
        .catch((error) => {
          console.error("Errore durante la richiesta API:", error);
        });
      console.log(this.subjects);
    },

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
    // axios
    //   .get(store.apiURL)
    //   .then((res) => {
    //     const data = res.data;
    //     if (data.status === "success") {
    //       this.teachers = data.teachers;
    //       // console.log(this.teachers);
    //     }
    //   })
    //   .catch((err) => {
    //     console.log(err);
    //   });
    this.SearchProf("");
  },
};
</script>

<template>
  <div class="container">
    <div class="col-3">
      <label for="search">Ricerca</label>
      <input
        class="form-control"
        type="text"
        placeholder="cerca o inizia una nuova chat"
        aria-label="Search"
        v-model="store.SearchT"
        @keyup.enter="SearchProf(store.SearchT)"
      />
    </div>

    <!-- CHECKBOX -->

    <div class="col-3" v-for="subject in subjects" :key="subject.id">
      <label>
        <input
          type="checkbox"
          :value="subject"
          v-model="this.SubjectSelect"
          @click="handleCheckboxClick(this.SubjectSelect)"
        />
        {{ subject }}
      </label>
    </div>

    <div class="row mt-4">
      <div class="col-3 p-2" v-for="teacher in teachers" :key="teacher.id">
        <RouterLink
          :to="{ name: 'show', params: { id: teacher.id } }"
          @click="riempiVet(teacher.id)"
          class="text-decoration-none"
        >
          <div class="card pt-3 border-0 shadow">
            <div
              class="d-flex justify-content-center align-items-center img_circle mx-auto"
              style="height: 200px"
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
</template>
<style>
.img_circle {
  width: 60%;
}
</style>
