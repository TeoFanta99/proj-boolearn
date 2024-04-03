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
      //   console.log(store.NameSurname);
      //   console.log(store.UserEmail);
      //   console.log(store.EmailTitle);
      //   console.log(store.EmailMessage);
      //   console.log(store.List.user.id);
      const DatatoSend = {
        user_name: store.NameSurname,
        user_email: store.UserEmail,
        email_title: store.EmailTitle,
        description: store.EmailMessage,
        teacher_id: store.List.id,
      };
      axios
        .post("http://127.0.0.1:8000/api/v1/message", DatatoSend)

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
  <h2>CONTATTA L'INSEGNANTE!</h2>
  <br />

  <form @submit.prevent="test">
    <div class="mb-3">
      <label for="name_surname" class="form-label">NOME E COGNOME</label>
      <input
        v-model="store.NameSurname"
        type="text"
        name="user_name"
        id="name_surname"
        class="form-control"
        placeholder="Inserisci il tuo nome e cognome"
      />
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">INDIRIZZO EMAIL</label>
      <input
        v-model="store.UserEmail"
        type="email"
        name="user_email"
        id="email"
        class="form-control"
        placeholder="Inserisci la tua email"
      />
    </div>
    <div class="mb-3">
      <label for="email_title" class="form-label">OGGETTO</label>
      <input
        v-model="store.EmailTitle"
        type="text"
        name="email_title"
        id="email_title"
        class="form-control"
        placeholder="Oggetto della mail"
      />
    </div>
    <label for="email_text" class="form-label">CONTENUTO DELLA MAIL</label>
    <textarea
      v-model="store.EmailMessage"
      name="description"
      id="email_text"
      class="form-control"
      placeholder="Scrivi un messaggio"
      style="width: 100%; height: 150px"
    ></textarea>
    <!-- GLI SI PASSA IL PARAMETRO DALLO STORE.LIST CON L'ID DEL DOCENTE -->
    <!-- <input type="email" v-model="store.List.user.email" readonly /> -->
    <div class="d-flex justify-content-center">
      <input
        type="submit"
        class="mt-3 btn btn-primary w-75"
        value="INVIA MESSAGGIO"
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
    MESSAGGIO INVIATO CON SUCCESSO!
  </div>
</template>

<style lang="scss" scoped>
h2 {
  text-align: center;
  font-size: 30px;
  font-weight: 600;
  background-image: linear-gradient(to bottom left, #553c9a, #ee4b2b);
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
}
</style>
