import "vue-toastification/dist/index.css";
import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index.js'
import Toast from "vue-toastification";
const app = createApp(App)
app.use(Toast, {
    transition: "Vue-Toastification__fade",
    maxToasts: 4,
    newestOnTop: false
  });
app.use(router)
app.mount('#app')



