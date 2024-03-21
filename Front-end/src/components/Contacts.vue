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
};
</script>

<template>
  <section class="background">
    <div class="container contact-form">
      <div class="contact-image">
        <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact" />
      </div>
      <form method="post">
        <h3>CONTATTACI SUBITO!</h3>
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <input type="text" name="txtName" class="form-control" placeholder="NOME *" value="" />
            </div>
            <div class="form-group  mb-3">
              <input type="text" name="txtEmail" class="form-control" placeholder="COGNOME *" value="" />
            </div>
            <div class="form-group  mb-3">
              <input type="text" name="txtPhone" class="form-control" placeholder="EMAIL *" value="" />
            </div>
            <div class="col-md-12  mb-3">
              <div class="form-group">
                <textarea name="txtMsg" class="form-control" placeholder="MESSAGGIO *"
                  style="width: 100%; height: 150px;"></textarea>
              </div>
            </div>
            <div class="form-group d-flex justify-content-center mb-3">
              <input type="submit" name="btnSubmit" class="btnContact" value="INVIA MESSAGGIO" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</template>

<style lang="scss" scoped>
@use "../styles/header.scss";
//Scss relativo alla sola sezione di header
@use "../styles/partials/variables" as *;
@use "../styles/contact.scss";
</style>
