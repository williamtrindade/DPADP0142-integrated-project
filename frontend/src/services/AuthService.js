import axios from 'axios'
import UserService from '@/services/UserService'

export default {

    login: async (email, password) => {
        const data = {
            grant_type: 'password',
            client_id: process.env.VUE_APP_CLIENT_ID,
            client_secret: process.env.VUE_APP_SECRET,
            username: email,
            password: password
        }
        return await axios
            .post('/oauth/token', data)
            .then(async (resp) => {
                // Save token in localStorage
                const token = resp.data
                localStorage.setItem('token_type', token.token_type)
                localStorage.setItem('access_token', token.access_token)
                localStorage.setItem('expires_in', token.expires_in)
                localStorage.setItem('refresh_token', token.refresh_token)

                // Get Account/User data
                const data = await UserService.getMe()
                localStorage.setItem('user_name', data.name)
                localStorage.setItem('user_email', data.email)
                localStorage.setItem('account_id', data.account_id)
                localStorage.setItem('user_id', data.id)
            })
            .catch((error) => Promise.reject(error))
    },

    logout: () => {
        localStorage.removeItem('token_type')
        localStorage.removeItem('access_token')
        localStorage.removeItem('expires_in')
        localStorage.removeItem('refresh_token')
        localStorage.removeItem('user_name')
        localStorage.removeItem('user_email')
        localStorage.removeItem('account_id')
        localStorage.removeItem('user_id')
    },

    refreshToken: async () => {
        const data = {
            grant_type: 'refresh_token',
            refresh_token: localStorage.getItem('refresh_token'),
            client_id: process.env.VUE_APP_CLIENT_ID,
            client_secret: process.env.VUE_APP_SECRET
        }
        return await axios.post('/oauth/token', data)
    }
}
