<script>
//importo store
import axios from "axios";
import { store } from "../store";

export default {
  name: "ReviewForm",

  data() {
    return {
      store,
      success: false,
    };
  },

  methods: {
    test() {
      const DatatoSend = {
        title: store.ReviewTitle,
        user_email: store.UserEmail,
        description: store.EmailMessage,
        teacher_id: store.List.user.id,
      };
      axios
        .post("http://127.0.0.1:8000/api/v1/review", DatatoSend)

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
  <h2>Lascia una recensione all'insegnante!</h2>
  <br />

  <form @submit.prevent="test">
    <div class="mb-3">
      <input
        v-model="store.ReviewTitle"
        type="text"
        name="title"
        id="title"
        class="form-control mt-2"
        placeholder="Dai un titolo alla recensione"
      />

      <input
        v-model="store.UserEmail"
        type="email"
        name="user_email"
        id="email"
        class="form-control mt-2"
        placeholder="Inserisci la tua email"
      />

      <textarea
        v-model="store.EmailMessage"
        class="w-100 mt-3"
        style="height: 200px"
        name="description"
        id="description"
      ></textarea>
    </div>
    <input
      type="submit"
      class="mt-3 btn btn-primary w-75"
      value="AGGIUNGI RECENSIONE"
    />
  </form>

  <div v-if="success" style="color: green">
    Recensione aggiunta con successo!
  </div>
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
