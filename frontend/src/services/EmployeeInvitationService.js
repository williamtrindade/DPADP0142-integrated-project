import axios from 'axios'
import NotificationService from '@/services/NotificationService'

export default {

    inviteEmployee: async (email) => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        const data = {
            email: email
        }
        return await axios.post('/v1/employees/invite', data, options).then(async resp => {
            return (resp.status === 202)
        }).catch((err) => {
            if (err.response.status === 422) {
                NotificationService.throwValidationError(err.response.data.error)
                return
            }
            NotificationService.danger('Falha ao enviar e-mail.')
        })
    },

    validateHash: async (hash) => {
        const data = {
            hash: hash
        }
        return await axios.post('/employees/validate/hash', data).then(async resp => {
            return (resp.status === 200)
        }).catch(() => {
            return false
        })
    }
}
