import axios from 'axios'

export default {

    createByHash: async (user) => {
        return await axios.post('/users/invitation/hash', user)
    },

    getAll: async (params) => {
        const url = (params != null) ? '/v1/users' + params : '/v1/users'
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return axios
            .get(url, options)
            .then((resp) => resp.data.data.data)
            .catch((error) => Promise.reject(error))
    },

    getUser: async (id) => {
        return await axios
            .get('/v1/users/' + id, {
                headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
            })
            .then((resp) => resp.data.data)
            .catch((error) => Promise.reject(error))
    },

    getMe: async () => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return await axios
            .get('/v1/me/', options)
            .then((resp) => resp.data.data)
            .catch((error) => Promise.reject(error))
    },

    updateMe: async (user) => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        return await axios
            .put('/v1/me', user, options)
            .then((resp) => resp.data.data)
            .catch((error) => Promise.reject(error))
    },

    updateUser: async (data, id) => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        if (data.password == null) {
            delete data.password
        }
        return await axios
            .put(`/v1/users/${id}`, data, options)
            .then((resp) => resp.data.data)
            .catch((error) => Promise.reject(error))
    },

    updateWorkingHour: async (userId, workingHourId) => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        return await axios.put(`/v1/users/${userId}/working/hour/${workingHourId}`, {}, options)
    },

    updateAddress: async (lat, lng, addressText, userId) => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        const data = { lat: String(lat), lng: String(lng), address: addressText }
        return await axios.put(`/v1/users/${userId}/address`, data, options)
            .then((resp) => resp.data.data)
            .catch((error) => Promise.reject(error))
    },

    delete: async (id) => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        return axios
            .delete('/v1/users/' + id, options)
    }
}
