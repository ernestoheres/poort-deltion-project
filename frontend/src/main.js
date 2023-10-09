import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createRouter, createWebHistory } from 'vue-router'
import LoginView from './views/LoginView.vue'
import HomeView from './views/HomeView.vue'

const routes = [
    { path: '/', component: HomeView},
    { path: '/login', component: LoginView    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})



import App from './App.vue'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
