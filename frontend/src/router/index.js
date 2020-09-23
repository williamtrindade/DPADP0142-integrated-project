import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/views/Home'
import Login from '@/views/auth/Login'
import NotFound from '@/views/exceptions/NotFound'
import ManagerDash from '@/views/manager/ManagerDash'
import EmployeeDash from '@/views/employee/EmployeeDash'
import Register from '@/views/auth/Register'
import Settings from '@/views/manager/settings/Settings'
import ListEmployees from '@/views/manager/employees/ListEmployees'
import CreateEmployees from '@/views/manager/employees/CreateEmployee'
import EmployeeRegister from '@/views/employee/register/EmployeeRegister'
import RoutesHandler from '@/router/routesHandler'

Vue.use(VueRouter)

const routes = [
    // Home
    {
        path: '/',
        name: 'home',
        component: Home
    },

    // Guest
    {
        path: '/auth/login',
        name: 'login',
        component: Login,
        meta: { isGuestRoute: true }
    },
    {
        path: '/auth/register',
        name: 'register',
        component: Register,
        meta: { isGuestRoute: true }
    },
    {
        path: '/employee/register',
        name: 'employee-register',
        component: EmployeeRegister,
        meta: { isGuestRoute: true }
    },

    // Exceptions
    {
        path: '*',
        name: 'not-found',
        component: NotFound
    },

    // Manager
    {
        path: '/manager/dash',
        name: 'manager-dash',
        component: ManagerDash,
        meta: { requireManagerPermission: true }
    },
    {
        path: '/manager/settings',
        name: 'manager-me-settings',
        component: Settings,
        meta: { requireManagerPermission: true }
    },
    {
        path: '/manager/employees',
        name: 'manager-employees',
        component: ListEmployees,
        meta: { requireManagerPermission: true }
    },
    {
        path: '/manager/employees/create',
        name: 'manager-create-employees',
        component: CreateEmployees,
        meta: { requireManagerPermission: true }
    },

    // Employee
    {
        path: '/employee/dash',
        name: 'employee-dash',
        component: EmployeeDash,
        meta: { requireEmployeePermission: true }
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

router.beforeEach(function (to, from, next) {
    RoutesHandler.verifyPermission(to, from, next)
})
export default router
