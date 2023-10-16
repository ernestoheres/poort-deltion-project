import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createRouter, createWebHistory } from 'vue-router'
import LoginView from './views/LoginView.vue'
import HomeView from './views/HomeView.vue'
import UserView from './views/UserView.vue'

const routes = [
    { path: '/dashboard', component: HomeView},
    { path: '/dashboard/user/:id', component: UserView    },
    { path: '/', component: LoginView    },
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
