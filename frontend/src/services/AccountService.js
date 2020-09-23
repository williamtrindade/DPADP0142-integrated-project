import axios from 'axios'
import NotificationService from '@/services/NotificationService'
import AuthService from '@/services/AuthService'

export default {

    create: async (userName, userEmail, accountName, userPassword, accountCnpj, accountPhone) => {
        return axios.post('/accounts', {
            user_name: userName,
            user_email: userEmail,
            account_name: accountName,
            user_password: userPassword,
            account_cnpj: accountCnpj,
            account_phone: accountPhone
        }).then(resp => {
            return resp.status === 200
        }).catch((err) => {
            if (err.response.status === 500) {
                NotificationService.danger('Erro interno do servidor, tente novamente!')
            } else if (err.response.status === 422) {
                NotificationService.throwValidationErrors(err.response.data.data)
            }
            return false
        })
    },

    get: async () => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        return axios.get('/v1/accounts/' + localStorage.getItem('account_id'), options).then((resp) => {
            return {
                name: resp.data.data.name,
                cnpj: resp.data.data.cnpj,
                phone: resp.data.data.phone
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

    update: async (name, cnpj, phone) => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        const data = {
            name,
            cnpj,
            phone
        }
        return axios.put('/v1/accounts/' + localStorage.getItem('account_id'), data, options).then((resp) => {
            NotificationService.success('Dados alterados!')
            return {
                name: resp.data.data.name,
                cnpj: resp.data.data.cnpj,
                phone: resp.data.data.phone
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
                NotificationService.throwValidationErrors(err.response.data.data)
            }
            return false
        })
    }
}
