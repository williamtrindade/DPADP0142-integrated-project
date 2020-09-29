import axios from 'axios'

export default {

    login: (email, password) => {
        const data = {
            grant_type: 'password',
            client_id: process.env.VUE_APP_CLIENT_ID,
            client_secret: process.env.VUE_APP_SECRET,
            username: email,
            password: password
        }
        return axios.post('/oauth/token', data)
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
