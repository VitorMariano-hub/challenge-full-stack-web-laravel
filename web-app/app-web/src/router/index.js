// Composables
import { createRouter, createWebHistory } from 'vue-router'

import StudentCreate from '@/components/StudentCreate.vue'
import StudentEdit from '@/components/StudentEdit.vue'
import StudentDelete from '@/components/StudentDelete.vue'

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/default/Default.vue'),
    children: [
      {
        path: '/',
        name: 'Home',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import(/* webpackChunkName: "home" */ '@/views/Home.vue'),
      },
      {
        path: 'register', 
        name: 'register',
        component: StudentCreate, 
      },
      {
        path: '/edit/:id', 
        name: 'edit',
        component: StudentEdit,
        props: true,
      },
      {
        path: '/delete/:id', 
        name: 'delete',
        component: StudentDelete,
        props: true,
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})

export default router
