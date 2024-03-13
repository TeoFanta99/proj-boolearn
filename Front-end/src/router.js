import { createRouter, createWebHistory } from "vue-router";

// import Home from './App.vue';
// import About from './pages/About_Us.vue';
import contact from './components/Contacts.vue';
import Faq from './components/FAQ.vue';


const router = createRouter({
    history: createWebHistory(),
    routes: [
        
        // {
        //     path: '/about',
        //     name: 'about',
        //     component: About
        // },
        {
            path: '/faq',
            name: 'faq',
            component: Faq
        },
        {
            path: '/contact',
            name: 'contact',
            component: contact
        },
       
    ]
});

// Aggiungi un listener per l'evento load
window.addEventListener('load', () => {
    // Controlla l'URL corrente
    const currentPath = window.location.pathname;
  
    // Se l'URL è diverso dalla tua rotta principale, reimposta alle rotte originali
    if (currentPath !== '/') {
      router.push('/');
    }
});

export {router};