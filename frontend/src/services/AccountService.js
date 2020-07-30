import axios from 'axios'
export default {

    create: async (userName, userEmail, accountName, userPassword, accountCnpj) => {
        return axios.post('/accounts', {
            user_name: userName,
            user_email: userEmail,
            account_name: accountName,
            user_password: userPassword,
            account_cnpj: accountCnpj
        }).then(resp => {
            if (resp.status === 200) {
            }
            console.log(resp.data)
            return false
        }).catch(() => {
            return false
        })
    }

}
