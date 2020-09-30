import axios from 'axios'

export default {

    // Returns 202 Accepted
    inviteEmployee: async (email) => {
        const options = {
            headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') }
        }
        const data = {
            email: email
        }
        return axios.post('/v1/employees/invite', data, options)
    },

    validateHash: async (hash) => {
        const data = {
            hash: hash
        }
        return await axios
            .post('/employees/validate/hash', data)
    }
}
