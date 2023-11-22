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
import CalenderView from './views/CalenderView.vue'

const routes = [
  { path: '/dashboard', component: HomeView },
  { path: '/dashboard/user/add', component: UserRegistration, meta: { requiresAdmin: true } },
  { path: '/dashboard/archive', component: ArchiveView },
  { path: '/dashboard/calender', component: CalenderView },
  {
    path: '/dashboard/user/:id',
    component: UserView,
    name: 'UserView',
    props: (route) => ({ edit: route.query.edit === 'true' }),
  },
  { path: '/', component: LoginView },
  { path: '/forgot-password', component: ForgotPasswordView },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const role = localStorage.getItem('role');
  const userId = localStorage.getItem('userid');

  if (to.meta.requiresAdmin && role !== 'administrator') {
    next('/');
  } else if (to.path === '/') {
    if (role === 'doctor' || role === 'administrator') {
      next('/dashboard');
    } else if (role === 'client') {
      next(`/dashboard/user/${userId}`);
    } else {
      next();
    }
  } else if (to.path.startsWith('/dashboard')) {
    if (role !== 'client') {
      if (role === 'doctor' || role === 'administrator') {
        next();
      } else {
        next('/');
      }
    } else {
      if (to.path === `/dashboard/user/${userId}`) {
        next();
      } else {
        next('/');
      }
    }
  } else {
    next();
  }
});


import App from './App.vue'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
