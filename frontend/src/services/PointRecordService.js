import axios from 'axios'

export default {
    getAll: async () => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return await axios
            .get('/v1/pointRecords', options)
            .then((data) => (data.data.data.data))
            .catch((error) => Promise.reject(error))
    },
    create: async (pointRecord) => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return await axios.post('/v1/pointRecords', pointRecord, options)
    },
    approve: async (id) => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return await axios.put('/v1/pointRecords/' + id + '/approve', {}, options)
    },
    unapprove: async (id) => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return await axios.put('/v1/pointRecords/' + id + '/unapprove', {}, options)
    },
    getAllUnapproved: async () => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return await axios
            .get('/v1/pointRecords/unapproved?with=user', options)
            .then((data) => (data.data.data.data))
            .catch((error) => Promise.reject(error))
    }
}
