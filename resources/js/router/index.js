import { createRouter, createWebHistory } from 'vue-router'
import store from '../store'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('../views/Home'),
    meta: { requiresAuth: true }
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/auth/Login')
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('../views/auth/Register')
  },
  {
    path: '/profile',
    name: 'profile',
    component: () => import('../views/auth/Profile'),
    meta: { requiresAuth: true }
  },
  {
    path: '/admin',
    name: 'admin',
    component: () => import('../views/admin/Dashboard'),
    meta: { requiresAuth: true, requiresAdminRole: true },
    children: [
      {
        path: 'doctors',
        name: 'admin_doctors',
        component: () => import('../views/admin/doctor/Doctors'),
        meta: { requiresAuth: true, requiresAdminRole: true }
      },
      {
        path: 'doctors/:id',
        name: 'admin_doctor',
        component: () => import('../views/admin/doctor/Doctor'),
        meta: { requiresAuth: true, requiresAdminRole: true }
      },
      {
        path: 'patients',
        name: 'admin_patients',
        component: () => import('../views/admin/patient/Patients'),
        meta: { requiresAuth: true, requiresAdminRole: true }
      },
      {
        path: 'patients/:id',
        name: 'admin_patient',
        component: () => import('../views/admin/patient/Patient'),
        meta: { requiresAuth: true, requiresAdminRole: true }
      },
      {
        path: 'admins',
        name: 'admin_admins',
        component: () => import('../views/admin/admin/Admins'),
        meta: { requiresAuth: true, requiresAdminRole: true }
      },
      {
        path: 'admins/:id',
        name: 'admin_admin',
        component: () => import('../views/admin/admin/Admin'),
        meta: { requiresAuth: true, requiresAdminRole: true }
      },
      {
        path: 'specialities',
        name: 'admin_specialities',
        component: () => import('../views/admin/Specialities'),
        meta: { requiresAuth: true, requiresAdminRole: true }
      },
      {
        path: 'keywords',
        name: 'admin_keywords',
        component: () => import('../views/admin/Keywords'),
        meta: { requiresAuth: true, requiresAdminRole: true }
      },
      {
        path: 'appointmentsTypes',
        name: 'admin_appointmentsTypes',
        component: () => import('../views/admin/AppointmentsTypes'),
        meta: { requiresAuth: true, requiresAdminRole: true }
      }
    ]
  },
  {
    path: '/workstimes',
    name: 'workstimes',
    component: () => import('../views/workstime/Workstimes'),
    meta: { requiresAuth: true, requiresDoctorRole: true }
  },
  {
    path: '/appointments/:id/new',
    name: 'new_appointment',
    component: () => import('../views/appointments/NewAppointment'),
    meta: { requiresAuth: true }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.getters.logged_in) {
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    } else {
      if (to.matched.some(record => record.meta.requiresDoctorRole)) {
        if (!store.getters.is_doctor) {
          next({
            path: '/',
            query: { redirect: to.fullPath }
          })
        } else {
          next()
        }
      } else if (to.matched.some(record => record.meta.requiresAdminRole)) {
        if (!store.getters.is_admin) {
          next({
            path: '/',
            query: { redirect: to.fullPath }
          })
        } else {
          next()
        }
      } else {
        next()
      }
    }
  } else {
    next()
  }
})

export default router
