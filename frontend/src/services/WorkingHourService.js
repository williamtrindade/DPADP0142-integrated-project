import axios from 'axios'

export default {
    create: (data) => {
        // const data = data
        axios.post('/working/hours', data)
            .then((resp) => {
                console.log(resp)
            })
            .catch((err) => console.error(err))
    }
}
