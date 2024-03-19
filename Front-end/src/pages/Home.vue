<script>
import axios from "axios";
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
      return `http://localhost:8000/storage/${teacher.image_url}`;
    },

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

  watch: {
    // Osserva le modifiche nella variabile SubjectSelect
    SubjectSelect: function(newVal, oldVal) {
      // Quando SubjectSelect cambia, chiama la funzione SearchProf
      this.SearchProf();
    }
  },

  mounted() {
    // Chiamata iniziale per caricare i dati
    this.SearchProf();
  },
};
</script>


<template>
  <div class="container">
    <div class="row align-items-center">
      <!-- <div class="col-12 col-md-4">
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
      <!-- CHECKBOX -->
      <div class="col-12 col-md-8 align-self-end pb-2">
        <select v-model="selectedSubject">
    <option :value="this.teacher">Seleziona un soggetto</option>
    <option
        v-for="subject in subjects"
        :key="subject.id"
        :value="subject.name"
    >
        {{ subject.name }}
    </option>
</select>
      </div>
    </div>

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
</style>
