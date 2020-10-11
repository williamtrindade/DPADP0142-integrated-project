import axios from 'axios'

export default {

    create: async (user, account) => {
        const data = { user, account }
        return await axios.post('/accounts', data)
    },

    get: async () => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        return await axios
            .get('/v1/accounts/' + localStorage.getItem('account_id'), options)
            .then((resp) => resp.data.data)
            .catch((error) => Promise.reject(error))
    },

    update: async (account) => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return await axios.put('/v1/accounts/' + localStorage.getItem('account_id'), account, options)
            .then((resp) => resp.data.data)
            .catch((error) => Promise.reject(error))
    }
}
