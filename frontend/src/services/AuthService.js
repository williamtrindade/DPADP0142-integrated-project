import axios from 'axios'
export default {

    login: async (email, password) => {
        axios.post('/oauth/token', {
            grant_type: 'password',
            client_secret: process.env.VUE_APP_SECRET,
            client_id: process.env.VUE_APP_CLIENT_ID,
            username: email,
            password: password
        })
            .then(resp => {
                const token = resp.data
                console.log(token)
                localStorage.setItem('token_type', token.token_type)
                localStorage.setItem('access_token', token.access_token)
                localStorage.setItem('expires_in', token.expires_in)
                localStorage.setItem('refresh_token', token.refresh_token)
                return true
            })
            .catch(() => {
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
