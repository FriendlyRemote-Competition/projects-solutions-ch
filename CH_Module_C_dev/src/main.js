import './assets/bootstrap/css/bootstrap.min.css'
import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/bootstrap/js/bootstrap.js'

const app = createApp(App)

app.use(router)

app.mount('#app')
