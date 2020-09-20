import Vue from 'vue'

export default {

    throwValidationErros: (errors) => {
        Object.values(errors).forEach(val => {
            val.forEach((msg) => {
                Vue.notify({
                    group: 'error',
                    title: 'Erro de validação!',
                    text: msg,
                    duration: 10000
                })
            })
        })
    },

    throwValidationError: (error) => {
        Vue.notify({
            group: 'error',
            title: 'Erro de validação!',
            text: error,
            duration: 10000
        })
    },

    success: (message) => {
        Vue.notify({
            group: 'success',
            title: 'Sucesso!',
            text: message,
            duration: 10000
        })
    },

    danger: (message) => {
        Vue.notify({
            group: 'danger',
            title: 'Aviso!',
            text: message,
            duration: 10000
        })
    }

}
