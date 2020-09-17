import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home'

import Login from '../views/auth/Login'
import NotFound from '../views/exceptions/NotFound'
import ManagerDash from '../views/manager/Dash'
import Register from '../views/auth/Register'
import Settings from '../views/manager/settings/Settings'
import ListEmployees from '../views/manager/employees/ListEmployees'
import CreateEmployees from '../views/manager/employees/CreateEmployee.vue'

Vue.use(VueRouter)

const routes = [
    // Colaborator
    {
        path: '*',
        name: 'not-found',
        component: NotFound
    },
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/auth/login',
        name: 'login',
        component: Login
    },
    {
        path: '/auth/register',
        name: 'register',
        component: Register
    },
    // Manager
    {
        path: '/manager/dash',
        name: 'manager-dash',
        component: ManagerDash
    },
    {
        path: '/manager/settings',
        name: 'manager-me-settings',
        component: Settings
    },
    {
        path: '/manager/employees',
        name: 'manager-employees',
        component: ListEmployees
    },
    {
        path: '/manager/employees/create',
        name: 'manager-create-employees',
        component: CreateEmployees
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
