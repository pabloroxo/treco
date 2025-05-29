import './assets/main.css'
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const myApp = createApp(App)
myApp.use(router)
myApp.use(VueSweetalert2);
myApp.mount('#app')
