<script>
import axios from "axios";

//importo store
import { store } from "../store";

export default {
  name: "Show",

  data() {
    return {
      store,
    };
  },
  methods: {
    getImageUrl(teacher) {
      // Restituisci direttamente il percorso dell'immagine dell'insegnante
      return `http://localhost:8000/storage/${store.List.image_url}`;
    },
  },

  mounted() {
    console.log(store.List);

    // Ottieni i parametri di query
    const params = this.$route.query;

    // console.log(params);
  },
};
</script>

<template>
  <div v-if="store.view">
    <div class="container mb-4">
      <div class="row">
        <div class="col-4">
          <div class="img_container">
            <img class="w-100 h-100" :src="getImageUrl(store.List)" alt="" />
          </div>
        </div>
        <div class="col-8">
          <div class="d-flex align-items-center gap-2">
            <h2>{{ store.List.user.name }} {{ store.List.user.lastname }}</h2>
            <span>{{ store.List.city }}</span>
          </div>
          <h6>Teacher</h6>

          <div class="col-6">
            <h5 class="mt-4 border-bottom">Materie</h5>
            <div class="d-flex flex-column">
              <div class="d-flex gap-3 align-items-center">
                <ul>
                <li v-for="subject in store.List.subjects " :key="subject.id">{{ subject.name }}</li>
              </ul>
                
              </div>
            </div>
          </div>

          <div class="col-6">
            <h5 class="mt-4 border-bottom">Biografia</h5>
            <div class="d-flex flex-column">
              <div class="d-flex gap-3 align-items-center">
                <p>{{ store.List.biography }}</p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <h5 class="mt-2 border-bottom">Anagrafica</h5>
            <div class="d-flex flex-column">
              <div class="d-flex gap-2 align-items-center">
                <h6 class="mb-0">Data di nascita:</h6>
                <span id="DateBirth">{{ store.List.user.date_of_birth }}</span>
              </div>
              <div class="d-flex gap-3 align-items-center">
                <h6 class="mb-0">Partita Iva:</h6>
                <span>{{ store.List.tax_id }}</span>
              </div>
            </div>
          </div>
          <div class="col-6">
            <h5 class="mt-4 border-bottom">Contatti</h5>
            <div class="d-flex flex-column">
              <div class="d-flex gap-5">
                <h6>Telefono:</h6>
                <span>{{ store.List.phone_number }}</span>
              </div>
              <div class="d-flex gap-3 align-items-center">
                <h6 class="mb-0">Indirizzo Mail:</h6>
                <span>{{ store.List.user.email }}</span>
              </div>
            </div>
          </div>
          <div class="col-6">
            <h5 class="mt-4 border-bottom">Motto</h5>
            <div class="d-flex flex-column">
              <div class="d-flex gap-5">
                <span>{{ store.List.motto }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.img_circle {
  width: 60%;
}
</style>
