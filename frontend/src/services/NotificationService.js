import Swal from 'sweetalert2'

export default {

    throwValidationErrors: (errors) => {
        let data = ''
        Object.values(errors).forEach(val => {
            val.forEach((msg) => {
                data = data + '\n' + msg
            })
        })
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data
        })
    },

    throwValidationError: (error) => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error
        })
    },

    success: (message) => {
        Swal.fire(
            'Sucesso!',
            message,
            'success'
        )
    },

    danger: (message) => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message
        })
    }

}
