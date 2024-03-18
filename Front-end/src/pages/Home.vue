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
      SubjectSelect: [],
      teacher: "",
    };
  },

  methods: {
    getImageUrl(teacher) {
      // Restituisci direttamente il percorso dell'immagine dell'insegnante
      return `http://localhost:8000/storage/${teacher.image_url}`;
    },
    handleCheckboxClick(subject) {
      if (!this.SubjectSelect.includes(subject)) {
        this.SubjectSelect.push(subject);
      } else {
        const index = this.SubjectSelect.indexOf(subject);
        if (index !== -1) {
          this.SubjectSelect.splice(index, 1);
        }
      }
      this.SearchProf();
    },
    SearchProf(teacher) {
  let dataToSend = { nome_cognome: teacher };

  // Se è stata selezionata almeno una materia, aggiungi il parametro 'subject' ai dati da inviare
  if (this.SubjectSelect.length > 0) {
    console.log(this.SubjectSelect);
    dataToSend.subjects = this.SubjectSelect;
  }

  axios
    .post("http://127.0.0.1:8000/api/v1/hgs", dataToSend)
    .then((response) => {
      this.teachers = response.data.teachers;
      // Se non ci sono materie selezionate, reimposta l'array di materie
      this.subjects= response.data.subjects;
      
        // this.teachers.forEach((teacher) => {
        //   teacher.subjects.forEach((subject) => {
        //     if (!this.subjects.includes(subject)) {
        //       this.subjects.push(subject);
              
        //     }
        //   });
        // });
      
    })
    .catch((error) => {
      console.error("Errore durante la richiesta API:", error);
    });
    
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
    <div class="row align-items-center">
      <div class="col-3">
        <label for="search">Ricerca</label>
        <input
          class="form-control"
          type="text"
          placeholder="Cerca un insegnante"
          aria-label="Search"
          v-model="store.SearchT"
          @keyup.enter="SearchProf(store.SearchT)"
        />
      </div>
      <!-- CHECKBOX -->
      <div class="col-7 align-self-end pb-2">
        <label v-for="subject in subjects" :key="subject.id" class="px-2">
          <input
            type="checkbox"
            :value="subject.name"
            v-model="SubjectSelect"
            @click="handleCheckboxClick(subject.name)"
          />
          {{ subject.name }}
        </label>
      </div>
    </div>

    <div v-if="teachers.length > 0">
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
    <div v-else>
      <h3 class="my-4">Nessun risultato trovato!</h3>
    </div>
  </div>
</template>
<style>
.img_circle {
  width: 60%;
}
</style>
