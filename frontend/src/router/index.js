import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home'

import Login from '../views/auth/Login'
import NotFound from '../views/exceptions/NotFound'
import ManagerDash from '../views/manager/Dash'
import Register from '../views/auth/Register'
import Settings from '../views/manager/settings/Settings'
import ListEmployees from '../views/manager/employees/ListEmployees'
import CreateEmployees from '../views/manager/employees/CreateEmployee'
import EmployeeRegister from '../views/employee/register/EmployeeRegister'

Vue.use(VueRouter)

const authenticated = (to, from, next) => {
    if (localStorage.getItem('access_token')) {
        next()
        return
    }
    next('/auth/login')
}

const unauthenticated = (to, from, next) => {
    if (!localStorage.getItem('access_token')) {
        next()
        return
    }
    next('/')
}

const routes = [
    // Guest
    {
        path: '/auth/login',
        name: 'login',
        component: Login,
        beforeEnter: unauthenticated
    },
    {
        path: '/auth/register',
        name: 'register',
        component: Register,
        beforeEnter: unauthenticated
    },
    {
        path: '/employee/register',
        name: 'employee-register',
        component: EmployeeRegister,
        beforeEnter: unauthenticated
    },

    // Colaborator
    {
        path: '*',
        name: 'not-found',
        component: NotFound
    },
    {
        path: '/',
        name: 'home',
        component: Home,
        beforeEnter: authenticated
    },

    // Manager
    {
        path: '/manager/dash',
        name: 'manager-dash',
        component: ManagerDash,
        beforeEnter: authenticated
    },
    {
        path: '/manager/settings',
        name: 'manager-me-settings',
        component: Settings,
        beforeEnter: authenticated
    },
    {
        path: '/manager/employees',
        name: 'manager-employees',
        component: ListEmployees,
        beforeEnter: authenticated
    },
    {
        path: '/manager/employees/create',
        name: 'manager-create-employees',
        component: CreateEmployees,
        beforeEnter: authenticated
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
