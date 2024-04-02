<script>
import axios from "axios";
import { store } from "../store";
import { useAttrs } from "vue";

export default {
  name: "jumbo",

  data() {
    return {};
  },
  methods: {},

  mounted() {
    const text = document.querySelector(".sec-text");

    const textLoad = (text) => {
      // Array di oggetti contenenti il testo e il colore per ciascun elemento
      const texts = [
        { singleText: "HTML", color: "#e5532d" },
        { singleText: "CSS", color: "#254bdd" },
        { singleText: "JS", color: "#efd81d" },
        { singleText: "PHP", color: "#254bdd" },
        { singleText: "LARAVEL", color: "#ff554d" },
        { singleText: "VueJS", color: "#3fb27f" },
      ];

      const setTextAndColor = (index) => {
        // Ottieni il testo e il colore dall'array
        const { singleText, color } = texts[index];

        // Imposta il testo e il colore
        text.textContent = singleText;
        text.style.color = color;

        // Incrementa l'indice, se è oltre la lunghezza dell'array, torna a 0
        const nextIndex = (index + 1) % texts.length;

        // Richiama ricorsivamente la funzione per il prossimo testo dopo un ritardo
        setTimeout(() => {
          setTextAndColor(nextIndex); // Passa l'indice successivo
        }, 4500); // Ritardo tra ogni testo in millisecondi
      };

      // Avvia il processo impostando il testo e il colore per il primo elemento nell'array
      setTextAndColor(0);
    };

    textLoad(text); // Avvia la sequenza
  },
};
</script>

<template class="bg-light">
  <div class="container-fluid p-0 bg-dark overflow-hidden">
    <div class="body-jumbo">
      <div class="opacity-75 bg-black position-absolute op_jumbo"></div>
      <div class="container_jumbo">
        <span class="text first-text">VOGLIO IMPARARE </span>
        <span class="text sec-text">HTML</span>
      </div>
    </div>
  </div>
</template>
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap");

.body-jumbo {
  background-image: url("https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExOHR3cTZ3cjBqYTZidjNnZGFybTRqN2I3YWd2ZWJuYTRnN3ZtYWhpbSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/26tn33aiTi1jkl6H6/giphy.gif");
  min-height: 30rem;
  display: flex;
  align-items: center;
  overflow: hidden;
  background-repeat: no-repeat;
  justify-content: center;
  background-size: 100%;
  /* background-position: 70% 50%; */
  position: relative;
}

.container_jumbo {
  position: absolute;
  width: 100%;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  padding: 0;
}

.text.first-text {
  color: #fff;
}

.op_jumbo {
  width: 100%;
  height: 100%;
}

.container_jumbo .text {
  position: relative;
  color: #1ce6b4;
  font-size: 52px;
  font-weight: 600;
}

.container_jumbo .text.first-text {
  color: #fff;
}

.text.sec-text:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  border-left: 2px solid #011d24;
  animation: animate 4s infinite;
}

.text.sec-text::after {
  content: " .";
}

@keyframes animate {

  40%,
  60% {
    left: calc(95% + 4px);
    width: 0%;
  }

  100% {
    left: 0%;
  }
}

/* MEDIA QUERY PER LA JUMBOTRUN */

@media (max-width: 575.98px) {
  .body-jumbo {
    min-height: 15rem;
    /* width: 35%; */
    background-position: 40%;

    .container_jumbo {
      padding: 0;

      span {
        font-size: 25px;
      }
    }
  }

  #boh {
    margin-bottom: 0;
    padding: 20px 0px;
  }
}

@media (min-width: 576px) and (max-width: 767.98px) {
  .body-jumbo {
    min-height: 20rem;
    /* width: 55%; */
    background-position: 40%;

    .container_jumbo {
      padding: 0;

      span {
        font-size: 40px;
      }
    }
  }
}

@media (min-width: 768px) and (max-width: 991.98px) {
  .body-jumbo {

    /* width: 60%; */
    .container_jumbo {
      span {
        font-size: 40px;
      }
    }
  }

  .op_jumbo {
    margin-right: 0;
    margin-left: 0;
  }
}

@media (min-width: 992px) and (max-width: 1199.98px) {
  .body-jumbo {
    /* width: 100%; */
    background-position: 50%;
  }
}
</style>
