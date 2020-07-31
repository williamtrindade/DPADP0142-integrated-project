import axios from 'axios'
import NotificationService from './NotificationService'

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
                NotificationService.throwValidationErros(err.response.data.data)
            }
            return false
        })
    }
}
