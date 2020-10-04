import Vue from 'vue'
import axios from 'axios'
import NotificationService from '@/services/NotificationService'

axios.defaults.baseURL = process.env.VUE_APP_API_URL

axios.interceptors.request
    .use((config) => {
        return config
    }, function (error) {
        return Promise.reject(error)
    })

axios.interceptors.response
    .use((response) => {
        return response
    }, (error) => {
        const status = error.response.status
        switch (status) {
            case 422:
                NotificationService.throwValidationErrors(error.response.data.data)
                break
            case 500:
                NotificationService.danger('Erro interno do servidor, tente novamente!')
                break
            case 401:
                alert('TOKEN EXPIRADO!')
                break
        }
        return Promise.reject(error)
    })

Vue.use({
    install (Vue) {
        Vue.prototype.$http = axios
    }
})
