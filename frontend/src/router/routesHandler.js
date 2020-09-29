import UserService from '@/services/UserService'

export default {
    verifyPermission: async (to, from, next) => {
        const isGuestRoute = to.meta.isGuestRoute ?? false
        const requireManagerPermission = to.meta.requireManagerPermission ?? false
        const requireEmployeePermission = to.meta.requireEmployeePermission ?? false
        const accessToken = localStorage.getItem('access_token')

        if (!(to.meta.isGuestRoute === true) && !requireManagerPermission && !requireEmployeePermission) {
            next()
            return
        }

        if (accessToken) {
            const user = await UserService.getMe()
            if (user.permission === '1' && requireManagerPermission) {
                next()
                return
            } else if (user.permission === '1') {
                next('/manager/dash')
                return
            }
            if (user.permission === '2' && requireEmployeePermission) {
                next()
                return
            } else if (user.permission === '2') {
                next('/employee/dash')
                return
            }
        } else if (isGuestRoute) {
            next()
            return
        } else {
            next('/auth/login')
            return
        }
        next()
    }
}
