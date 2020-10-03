import axios from 'axios'

export default {

    createByHash: async (name, email, password, hash) => {
        const data = { name: name, email: email, password: password, hash: hash }
        return await axios.post('/users/invitation/hash', data)
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

    update: async (name, email, password) => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        const data = {
            name: name,
            email: email
        }
        if (password != null) {
            data.password = password
        }
        return await axios
            .put('/v1/me', data, options)
            .then((resp) => {
                return resp.data.data
            })
            .catch((error) => Promise.reject(error))
    },

    updateWorkingHour: async (userId, workingHourId) => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        return await axios.put(`/v1/users/${userId}/working/hour/${workingHourId}`, {}, options)
    },

    delete: async (id) => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        return axios
            .delete('/v1/users/' + id, options)
    }
}
