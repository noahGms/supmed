require('./bootstrap');
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'

axios.defaults.baseURL = '/api'
axios.defaults.headers.common.Authorization = `Bearer ${store.getters.get_token}`

createApp(App).use(store).use(router).mount('#app')
