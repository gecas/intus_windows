import './bootstrap';
import { createApp } from "vue";
import App from "./layouts/app.vue";
import ShortenUrlForm from './components/ShortenUrlForm.vue'

createApp(App).component('shorten-url-form', ShortenUrlForm).mount("#app")
