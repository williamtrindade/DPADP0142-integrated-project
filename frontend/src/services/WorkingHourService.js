import axios from 'axios'

export default {

    getAll: async () => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return await axios.get('/v1/working/hours', options)
            .then((data) => (data.data.data.data))
            .catch((error) => Promise.reject(error))
    },

    create: async (data) => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return await axios.post('/v1/working/hours', data, options)
    },

    delete: async (id) => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return await axios.delete('/v1/working/hours/' + id, options)
    }
}
