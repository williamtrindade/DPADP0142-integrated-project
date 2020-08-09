import axios from 'axios'
import NotificationService from './NotificationService'
import AuthService from './AuthService'

export default {
    get: async () => {
        return axios.get('/v1/me/', {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }).then((resp) => {
            return {
                name: resp.data.data.name,
                email: resp.data.data.email,
                permission: resp.data.data.permission,
                account_id: resp.data.data.account_id,
                id: resp.data.data.id
            }
        }).catch((err) => {
            if (err.response.status === 500) {
                NotificationService.danger('Erro interno do servidor, tente novamente!')
            } else if (err.response.status === 401) {
                AuthService.refreshToken().then((resp) => {
                    console.log(resp)
                    NotificationService.danger(resp)
                })
            }
        })
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
        return axios.put('/v1/me', data, options).then((resp) => {
            NotificationService.success('Dados alterados!')
            return {
                name: resp.data.data.name,
                email: resp.data.data.email,
                permission: resp.data.data.permission
            }
        }).catch((err) => {
            if (err.response.status === 500) {
                NotificationService.danger('Erro interno do servidor, tente novamente!')
            } else if (err.response.status === 401) {
                AuthService.refreshToken().then((resp) => {
                    console.log(resp)
                    NotificationService.danger(resp)
                })
            } else if (err.response.status === 422) {
                NotificationService.throwValidationErros(err.response.data.data)
            }
            return false
        })
    }
}
