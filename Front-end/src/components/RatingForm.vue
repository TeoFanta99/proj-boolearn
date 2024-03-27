<script>
//importo store
import axios from "axios";
import { store } from "../store";

export default {
  name: "ContactTeacherForm",

  data() {
    return {
      store,
      success: false,
    };
  },

  methods: {
    test() {
      const DatatoSend = {
        idRating: store.Rating,
        teacher_id: store.List.user.id,
      };
      axios
        .post("http://127.0.0.1:8000/api/v1/rating", DatatoSend)

        .then((response) => {
          this.success = true;
        })
        .catch((error) => {
          console.error("Errore durante la richiesta API:", error);
        });
    },
  },

  mounted() {
    // console.log(store.List.user.email);
  },
};
</script>

<template>
  <br /><br />
  <h2>Dai un voto all'insegnante!</h2>
  <br />

  <form @submit.prevent="test">
    <div class="mb-3">
      <div class="d-flex flex-column">
        <p>Dai il tuo voto:</p>
        <label class="radio-inline">
          <input type="radio" name="optradio" value="1" v-model="store.Rating" />Pessimo
        </label>
        <label class="radio-inline">
          <input type="radio" name="optradio" value="2" v-model="store.Rating" />Scarso
        </label>
        <label class="radio-inline">
          <input type="radio" name="optradio" value="3" v-model="store.Rating" />Sufficiente
        </label>
        <label class="radio-inline">
          <input type="radio" name="optradio" value="4" v-model="store.Rating" />Buono
        </label>
        <label class="radio-inline">
          <input type="radio" name="optradio" value="5" v-model="store.Rating" />Ottimo
        </label>
      </div>
    </div>

    <input type="submit" class="mt-3 btn btn-primary w-75" value="INVIA VOTO" />
  </form>

  <div v-if="success" style="color: green">Votazione inviata con successo!</div>
</template>

<style lang="scss" scoped>
form {
  input {
    width: 100%;
  }

  .btnContact {
    width: 250px;
    border: none;
    border-radius: 1rem;
    // padding: 1.5%;
    background: #dc3545;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
  }
}
</style>
