import { createRouter, createWebHistory } from "vue-router";

// import Home from './App.vue';
import About from "./pages/About.vue";
import contact from "./components/Contacts.vue";
import Faq from "./components/FAQ.vue";
import Home from "./pages/Home.vue";
import Show from "./pages/Show.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/about",
      name: "about",
      component: About,
    },
    {
      path: "/faq",
      name: "faq",
      component: Faq,
    },
    {
      path: "/",
      name: "home",
      component: Home,
    },
    {
      path: "/contact",
      name: "contact",
      component: contact,
    },
    {
      path: "/show/:id",
      name: "show",
      component: Show,
    },
  ],
});

// Aggiungi un listener per l'evento load
window.addEventListener("load", () => {
  // Controlla l'URL corrente
  const currentPath = window.location.pathname;

  // Se l'URL è diverso dalla tua rotta principale, reimposta alle rotte originali
  if (currentPath !== "/") {
    router.push("/");
  }
});

export { router };
