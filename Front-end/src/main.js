import { createApp } from "vue";
import App from "./App.vue";

// Import di Bootstrap
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import { router } from './router'


const app = createApp(App);
app.use(router);
app.mount('#app');
