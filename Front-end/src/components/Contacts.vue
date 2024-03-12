<script>
//importo store
import { store } from "../store";

export default {
  name: "Contacts",

  data() {
    return {
      store,
    };
  },
  methods: {
    getRequest() {
      console.log(
        "PushTask:" +
          store.NameSurname +
          store.Email +
          store.Title +
          store.Message
      );
    },
  },
  computed: {
    // numcard() {
    //   return store.CardList.length;
    // },
  },
};
</script>

<template>
  <div class="background">
    <div class="container">
      <div class="row">
        <h2>Contattaci subito!</h2>

        <!-- Contatti -->
        <div class="col">
          <h3>Scrivici</h3>
          <p>
            Boolearn <br />
            Via Vattela a Pesca 91 <br />
            prova(PR)
          </p>
          <h3>Contattaci</h3>
          <p>
            Boolearn Assistenza<br />
            +39 555 444 777 <br />
            DA LUNEDI AL VENERDI : 10.00-11.00 / 16.00-17.00
          </p>
        </div>

        <!-- Form seconda colonna -->
        <div class="col">
          <form @submit.prevent="getRequest">
            <div class="mb-3">
              <label class="form-label"
                >Nome e Cognome:<span class="required">*</span></label
              >
              <input
                type="text"
                placeholder="Nome e cognome"
                id="nmSr"
                v-model.trim="store.NameSurname"
                class="form-control"
              />
            </div>
            <div class="mb-3">
              <label class="form-label"
                >Email:<span class="required">*</span></label
              >
              <input
                type="email"
                placeholder="Email"
                class="form-control"
                id="e-mail"
                v-model.trim="store.Email"
                aria-describedby="emailHelp"
              />
            </div>
            <div class="mb-3">
              <label class="form-label"
                >Titolo:<span class="required">*</span></label
              >
              <input
                type="text"
                class="form-control"
                id="title"
                v-model.trim="store.Title"
                placeholder="Messaggio"
                aria-describedby="emailHelp"
              />
            </div>

            <div class="mb-3">
              <label class="form-label"
                >Messaggio:<span class="required">*</span></label
              >
              <textarea
                name="body"
                class="form-control"
                id="messaggio"
                rows="3"
                placeholder="Messaggio"
                v-model.trim="store.Message"
                required=""
                aria-required="true"
              ></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Invia</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
//Scss relativo alla sola sezione di header
@use "../styles/partials/variables" as *;

.background {
  background-color: rgb(113, 169, 253);

  .row {
    justify-content: center;
    margin-top: 150px;
    border-radius: 10px;
    text-align: center;
    padding: 20px;
    background-color: white;
    box-shadow: 0 4px 10px -3px rgba(0, 0, 0, 0.2);

    .required {
      color: $required;
    }
  }
}
</style>
