import axios from 'axios'

export default {
    getAll: async () => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return axios
            .get('/v1/reports', options)
            .then((resp) => resp.data.data)
            .catch((error) => Promise.reject(error))
    }
}
