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
        teacher_id: store.List.id,
      };

      console.log(DatatoSend);
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
  <h2>LASCIA UNA RECENSIONE!</h2>
  <br />

  <form @submit.prevent="test">
    <div class="mb-3">
      <label class="form-label">TITOLO DELLA RECENSIONE</label>
      <input
        v-model="store.ReviewTitle"
        type="text"
        name="title"
        id="title"
        class="form-control"
        placeholder="Dai un titolo alla recensione"
      />
    </div>
    <div class="mb-3">
      <label class="form-label">INDIRIZZO EMAIL</label>
      <input
        v-model="store.UserEmail"
        type="email"
        name="user_email"
        id="email"
        class="form-control"
        placeholder="Inserisci la tua email"
      />
    </div>
    <label class="form-label">TESTO DELLA RECENSIONE</label>
    <textarea
      v-model="store.EmailMessage"
      class="form-control"
      style="height: 200px"
      name="description"
      id="description"
      placeholder="Digita qui la tua recensione"
    ></textarea>
    <div class="d-flex justify-content-center">
      <input
        type="submit"
        class="mt-3 mb-3 btn btn-primary w-75"
        value="AGGIUNGI RECENSIONE"
      />
    </div>
  </form>

  <div
    class="d-flex justify-content-center mt-4"
    v-if="success"
    style="
      color: green;
      font-weight: bolder;
      font-size: 25px;
      text-align: center;
    "
  >
    RECENSIONE INVIATA CON SUCCESSO!
  </div>
</template>

<style lang="scss" scoped>
h2 {
  text-align: center;
  font-size: 30px;
  font-weight: 600;
  background-image: linear-gradient(45deg, #553c9a, #ee4b2b);
  color: transparent;
  background-clip: text;
  -webkit-background-clip: text;
}

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

.form-label {
  font-weight: bold;
  margin-left: 10px;
}

.form-control {
  margin-left: 5px;
  width: 95%;
}
</style>
