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
      loading: true,
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
        .post("http://127.0.0.1:8000/api/v1/result", dataToSend)
        .then((response) => {
          console.log(response.data);
          this.teachers = response.data;
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
          store.view = 1;
          console.log(store.List);
        }
      });
    },
  },
  mounted() {
    this.population();
  },
};
</script>

<template>
  <div class="container">
    <div v-for="materia in store.materie">
      <h2 v-if="store.Subject == materia.id">Materia: {{ materia.name }}</h2>
    </div>

    <form class="d-flex">
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
          <option value="5">min 5</option>
          <option value="10">min 10</option>
          <option value="12">min 12</option>
        </select>
      </div>

      <button
        type="submit"
        form="nameform"
        value="Submit"
        class="btn btn-danger"
        @click="riempiRec()"
      >
        ricerca
      </button>
    </form>

    <div v-if="loading"><h3>Caricamento...</h3></div>
    <div v-else-if="teachers.length > 0">
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
