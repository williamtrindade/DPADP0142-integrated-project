import axios from 'axios'
export default {

    login: async (email, password) => {
        return axios.post('/oauth/token', {
            grant_type: 'password',
            client_id: process.env.VUE_APP_CLIENT_ID,
            client_secret: process.env.VUE_APP_SECRET,
            username: email,
            password: password
        }).then(resp => {
            if (resp.status === 200) {
                const token = resp.data
                localStorage.setItem('token_type', token.token_type)
                localStorage.setItem('access_token', token.access_token)
                localStorage.setItem('expires_in', token.expires_in)
                localStorage.setItem('refresh_token', token.refresh_token)
                return true
            }
            return false
        }).catch(() => {
            return false
        })
    },

    logout: () => {
        localStorage.removeItem('token_type')
        localStorage.removeItem('access_token')
        localStorage.removeItem('expires_in')
        localStorage.removeItem('refresh_token')
    }
}
