import axios from 'axios'

export default {

    create: async (data) => {
        const options = { headers: { authorization: 'Bearer ' + localStorage.getItem('access_token') } }
        // const data = data
        return await axios.post('/v1/working/hours', data, options)
            .then((resp) => {
                console.log(resp)
            })
            .catch((error) => Promise.reject(error))
    }
}
