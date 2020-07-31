import Vue from 'vue'

export default {

    throwValidationErros: (errors) => {
        Object.values(errors).forEach(val => {
            val.forEach((msg) => {
                Vue.notify({
                    group: 'error',
                    title: 'Erro de validação!',
                    text: msg,
                    duration: 40000
                })
            })
        })
    },

    success: (message) => {
        Vue.notify({
            group: 'success',
            title: 'Sucesso!',
            text: message,
            duration: 40000
        })
    },

    danger: (message) => {
        Vue.notify({
            group: 'danger',
            title: 'Aviso!',
            text: message,
            duration: 40000
        })
    }

}
