import axios from 'axios'

export default {

    create: async (
        userName,
        userEmail,
        accountName,
        userPassword,
        accountCnpj,
        accountPhone
    ) => {
        const data = {
            user_name: userName,
            user_email: userEmail,
            account_name: accountName,
            user_password: userPassword,
            account_cnpj: accountCnpj,
            account_phone: accountPhone
        }
        return await axios.post('/accounts', data)
    },

    get: async () => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        return await axios
            .get('/v1/accounts/' + localStorage.getItem('account_id'), options)
            .then((resp) => resp.data.data)
            .catch((error) => Promise.reject(error))
    },

    update: async (name, cnpj, phone) => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        const data = { name, cnpj, phone }
        return await axios
            .put('/v1/accounts/' + localStorage.getItem('account_id'), data, options)
            .then((resp) => resp.data.data)
            .catch((error) => Promise.reject(error))
    }
}
