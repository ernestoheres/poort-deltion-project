import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createRouter, createWebHistory } from 'vue-router'
import LoginView from './views/LoginView.vue'
import ForgotPasswordView from './views/ForgotPassword.vue'
import verklaring from './views/Privacy-cookie-verklaring.vue'
import HomeView from './views/HomeView.vue'
import ClientView from './views/ClientView.vue'
import ClientRegistration from './views/ClientRegistration.vue'
import UserRegistration from './views/UserRegistration.vue'
import ArchiveView from './views/ArchiveView.vue'
import agendaView from './views/agendaView.vue'
import RegisterView from './views/RegisterView.vue'

const routes = [
  { path: '/dashboard', component: HomeView },
  { path: '/dashboard/client/add', component: ClientRegistration, meta: { requiresAdmin: true } },
  { path: '/dashboard/user/add', component: UserRegistration, meta: { requiresManager: true } },
  { path: '/dashboard/archive', component: ArchiveView },
  { path: '/dashboard/agenda', component: agendaView },
  {
    path: '/dashboard/client/:id',
    component: ClientView,
    name: 'ClientView',
    props: (route) => ({ edit: route.query.edit === 'true' }),
  },
  { path: '/', component: LoginView },
  { path: '/register', component: RegisterView},
  { path: '/forgot-password', component: ForgotPasswordView },

  { path: '/privacy-en-cookieverklaring', component: verklaring },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const role = localStorage.getItem('role');
  const userId = localStorage.getItem('userid');

  // Check for admin-only routes
  if (to.meta.requiresAdmin && role !== 'administrator' && role !== 'manager') {
    next('/');
  }
  // Handling the root path '/'
  else if (to.path === '/') {
    if (role === 'doctor' || role === 'administrator' || role === 'manager') {
      next('/dashboard');
    } else if (role === 'client') {
      next(`/dashboard/client/${userId}`);
    } else {
      next();
    }
  }
  // Handling paths that start with '/dashboard'
  else if (to.path.startsWith('/dashboard')) {
    // Explicitly handling the manager role
    if (role === 'manager') {
      next();  // Allow managers to stay on the dashboard
    } 
    else if (to.meta.requiresManager && role !== 'manager') {
      next('/');
    } 
    else if (role !== 'client') {
      if (role === 'doctor' || role === 'administrator') {
        next();
      } else {
        next('/');
      }
    } 
    else {
      if (to.path === `/dashboard/client/${userId}`) {
        next();
      } else {
        next('/');
      }
    }
  }
  // Default case
  else {
    next();
  }
});


function checkLoginExpiration() {
  const loginDate = localStorage.getItem("loginDate");

  if (loginDate) {
    const fourteenDaysAgo = new Date();
    fourteenDaysAgo.setDate(fourteenDaysAgo.getDate() - 14);

    if (new Date(loginDate) < fourteenDaysAgo) {
      localStorage.removeItem("token");
      localStorage.removeItem("role");
      localStorage.removeItem("userid");
      localStorage.removeItem("loginDate");

      next('/'); // Redirect to the login page
    }
  }
}


import App from './App.vue'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')

checkLoginExpiration();