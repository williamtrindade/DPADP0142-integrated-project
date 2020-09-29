import axios from 'axios'
import NotificationService from '@/services/NotificationService'

export default {

    createByHash: async (name, email, password, hash) => {
        const data = { name: name, email: email, password: password, hash: hash }
        return axios.post('/users/invitation/hash', data)
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
        return axios
            .get('/v1/users/' + id, {
                headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
            })
            .then((resp) => resp.data.data)
            .catch((error) => error)
    },

    getMe: async () => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        return axios
            .get('/v1/me/', options)
            .then((resp) => resp.data.data)
            .catch((error) => error)
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
        return axios
            .put('/v1/me', data, options)
            .then((resp) => {
                NotificationService.success('Dados do usuário alterados com sucesso!')
                return resp.data.data
            })
            .catch(() => false)
    },

    delete: async (id) => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        return axios
            .delete('/v1/users/' + id, options)
            .then(() => {
                NotificationService.success('Usuário deletado!')
                return true
            })
            .catch((error) => error)
    }
}
