import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/views/Home'
import Login from '@/views/auth/Login'
import NotFound from '@/views/exceptions/NotFound'
import ManagerDash from '@/views/manager/ManagerDash'
import EmployeeDash from '@/views/employee/EmployeeDash'
import Register from '@/views/auth/Register'
import ManagerSettings from '@/views/manager/settings/ManagerSettings'
import ListEmployees from '@/views/manager/employees/ListEmployees'
import CreateEmployees from '@/views/manager/employees/CreateEmployee'
import EmployeeRegister from '@/views/employee/register/EmployeeRegister'
import RoutesHandler from '@/router/routesHandler'
import ViewEmployee from '@/views/manager/employees/ViewEmployee'
import ListWorkingHours from '@/views/manager/working-hours/ListWorkingHours'
import CreateWorkingHour from '@/views/manager/working-hours/CreateWorkingHour'
import EditWorkingHour from '@/views/manager/working-hours/EditWorkingHour'
import EditEmployee from '@/views/manager/employees/EditEmployee'
import ListPointRecords from '@/views/employee/point-records/ListPointRecords'
import EmployeeSettings from '@/views/employee/settings/EmployeeSettings'
import CreatePointRecord from '@/views/employee/point-records/CreatePointRecord'
import ListPointRecordRequests from '@/views/manager/point-record-requests/ListPointRecordRequests'

Vue.use(VueRouter)

const routes = [
    // Home
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: { isGuestRoute: true }
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
        name: 'manager-settings',
        component: ManagerSettings,
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
    {
        path: '/manager/employees/view/:id',
        name: 'manager-view-employee',
        component: ViewEmployee,
        meta: { requireManagerPermission: true }
    },
    {
        path: '/manager/employees/edit/:id',
        name: 'manager-edit-employee',
        component: EditEmployee,
        meta: { requireManagerPermission: true }
    },
    {
        path: '/manager/working/hours',
        name: 'manager-working-hours',
        component: ListWorkingHours,
        meta: { requireManagerPermission: true }
    },
    {
        path: '/manager/working/hours/create',
        name: 'manager-create-working-hours',
        component: CreateWorkingHour,
        meta: { requireManagerPermission: true }
    },
    {
        path: '/manager/working/hours/edit/:id',
        name: 'manager-edit-working-hours',
        component: EditWorkingHour,
        meta: { requireManagerPermission: true }
    },
    {
        path: '/manager/point-record-requests',
        name: 'manager-list-point-record-requests',
        component: ListPointRecordRequests,
        meta: { requireManagerPermission: true }
    },
    // Employee
    {
        path: '/employee/dash',
        name: 'employee-dash',
        component: EmployeeDash,
        meta: { requireEmployeePermission: true }
    },
    {
        path: '/employee/settings',
        name: 'employee-settings',
        component: EmployeeSettings,
        meta: { requireEmployeePermission: true }
    },
    {
        path: '/employee/point-records',
        name: 'employee-list-point-records',
        component: ListPointRecords,
        meta: { requireEmployeePermission: true }
    },
    {
        path: '/employee/point-records/create',
        name: 'employee-create-point-records',
        component: CreatePointRecord,
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
