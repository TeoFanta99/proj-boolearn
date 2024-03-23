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
            console.log(store.NameSurname);
            console.log(store.UserEmail);
            console.log(store.EmailTitle);
            console.log(store.EmailMessage);

            axios
                .post('http://127.0.0.1:8000/api/v1/message')
                .then((response) => {
                    ;
                })
                .catch((error) => {
                    console.error("Errore durante la richiesta API:", error);
                });




            this.success = true;
        },

    },

    mounted() {
        console.log(store.List.user.email);
    }
}
</script>

<template>

    <br><br>
    <h2>Contatta l'insegnante!</h2>
    <br>
    <form @submit.prevent="test">

        <input v-model="store.NameSurname" type="text" name="name_surname" id="name_surname"
            placeholder="Inserisci il tuo nome e cognome">
        <input v-model="store.UserEmail" type="email" name="email" id="email" placeholder="Inserisci la tua email">
        <br><br>
        <input type="email" v-model=store.List.user.email readonly>
        <input v-model="store.EmailTitle" type="text" name="email_title" id="email_title"
            placeholder="Oggetto della mail">
        <textarea v-model="store.EmailMessage" name="" id="" placeholder="Scrivi un messaggio"
            style="width: 100%; height: 150px;"></textarea>
        <input type="submit" value="INVIA MESSAGGIO" />

    </form>

    <div v-if="success" style="color: green;">Messaggio inviato con successo!</div>
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
