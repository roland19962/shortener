import './bootstrap';

import { createApp } from "vue/dist/vue.esm-bundler";

import App from './views/App.vue'
import MainPageShortener from "./components/MainPageShortener.vue";

import { VuePreloader } from 'vue-preloader';
import '../../node_modules/vue-preloader/dist/style.css'

import axios from "axios";

window.axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    return Promise.reject(error);
});


window.axios = axios;

const app = createApp({
    App
});

app.component('app-content', App);
app.component('VuePreloader', VuePreloader);
app.component('MainPageShortener', MainPageShortener);

app.mount('#app')
