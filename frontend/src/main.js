import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createRouter, createWebHistory } from 'vue-router'
import LoginView from './views/LoginView.vue'
import ForgotPasswordView from './views/ForgotPassword.vue'
import HomeView from './views/HomeView.vue'
import UserView from './views/UserView.vue'
import UserRegistration from './views/UserRegistration.vue'
import ArchiveView from './views/ArchiveView.vue'

const routes = [
    { path: '/dashboard', component: HomeView },
    { path: '/dashboard/user/add', component: UserRegistration },
    { path: '/dashboard/archive', component: ArchiveView },
    {
      path: '/dashboard/user/:id',
      component: UserView,
      name: 'UserView',
      props: (route) => ({ edit: route.query.edit === 'true' }),
    },
    { path: '/', component: LoginView },
    { path: '/forgot-password', component: ForgotPasswordView },
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
