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
      teachers:[]
    };
  },

  methods: {
    getImageUrl(teacher) {
      // Restituisci direttamente il percorso dell'immagine dell'insegnante
      return `http://localhost:8000/storage/${teacher.image_url}`;
    },
    riempiVet(id){
      this.teachers.forEach(element => {
          if(element.id == id){
            store.List=element;
            console.log(store.List);
          }
      });
    }
  },
  mounted() {
    axios
      .get(store.apiURL)
      .then((res) => {
        const data = res.data;
        if (data.status === "success") {
          this.teachers = data.teachers;
          
        }
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>

<template>
  <div class="container">
    <div class="row mt-4">
      <div class="col-3 p-2" v-for="teacher in teachers" :key="teacher.id">
        <RouterLink :to="{ name: 'show', params: { id: teacher.id } }" @click="riempiVet(teacher.id)">
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
