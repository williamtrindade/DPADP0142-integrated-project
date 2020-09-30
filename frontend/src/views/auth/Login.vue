<template>
    <div class="login">
        <div class="login-left align-middle">
            <div class="div-left-content shadow-lg bg-white">
                <h1 style="text-align: center" class="title-ponto">.Ponto</h1>
                <hr>
                <h2 id="form-title">Entre</h2>
                <hr>
                <form v-on:submit.prevent="login">
                    <div class="form-group">
                        <label for="email">Endereço de email</label>
                        <input
                            required
                            minlength="3"
                            maxlength="255"
                            v-model="email"
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Digite seu email."
                        />
                    </div>

                    <div class="form-group">
                        <label for="pass">Senha</label>
                        <input
                            required
                            minlength="6"
                            maxlength="500"
                            v-model="password"
                            type="password"
                            class="form-control"
                            id="pass"
                            placeholder="Digite sua senha."
                        />
                    </div>
                    <div class="justify-content-start float-left full-width" style="text-align: left;">
                        <button
                            id="send-button"
                            type="submit"
                            class="btn button-primary pl-5 pr-5"
                            style="border: none;">{{ loginButtonText }}
                        </button>
                        <router-link to="register">
                            <a href="#" class="link-text-login pl-3 pt-1" >Ainda não tenho conta!</a>
                        </router-link>
                    </div>
                </form>
            </div>
        </div>
        <div class="login-right">
        </div>
    </div>
</template>

<script>
import AuthService from '@/services/AuthService'
import NotificationService from '@/services/NotificationService'

export default {
    name: 'Login',
    data () {
        return {
            loginButtonText: 'Entrar',
            email: null,
            password: null
        }
    },
    methods: {
        async login () {
            this.blockSendButton()
            this.loginButtonText = 'Entrando...'
            AuthService.login(this.email, this.password)
                .then(async (resp) => {
                    this.$router.push({ name: 'home' })
                })
                .catch(() => {
                    NotificationService.danger('Falha na autenticação, tente novamente!')
                    this.loginButtonText = 'Reenviar dados'
                    this.unblockSendButton()
                })
        },
        blockSendButton () {
            document.querySelector('#send-button').disabled = true
        },
        unblockSendButton () {
            document.querySelector('#send-button').disabled = false
        }
    }
}
</script>

<style scoped>
.login {
    width: 100%;
    height: 100%;
}
.div-left-content {
    padding: 5%;
}

#form-title {
    font-size: 150%;
}
.login-left {
    background: rgb(0,255,157);
    background: linear-gradient(320deg, rgba(0,255,157,1) 0%, rgba(255,255,255,1) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    float: left;
    width: 50%;
    height: 100%;
    background-color: #ffffff;
    color: #000000;
}
.login-right {
    z-index: 1;
    background-image: url("../../../public/img/wal2.jpg");
    background-color: rgb(0,255,157);
    display: flex;
    align-items: center;
    justify-content: center;
    float: left;
    width: 50%;
    height: 100%;
    background-size: cover;
    background-position: center;
}
#form-title {
    font-size: 100%;
}

@media (max-width: 575.98px)  {
    .login-left {
        width: 100%;
    }
    .div-left-content {
        width: 90%;
    }
    .login-right {
        display: none;
    }
}
@media (min-width: 576px) and (max-width: 767.98px) {
    .div-left-content {
        width: 90%;
    }
    .login-left {
        width: 100%;
    }
    .login-right {
        display: none;
    }
}
@media (min-width: 768px) and (max-width: 991.98px) {
    .div-right-content p {
        font-size: 150%;
    }

    .div-left-content {
        width: 70%;
    }
}
@media (min-width: 992px) and (max-width: 1199.98px) {
}
@media (min-width: 1200px) and (max-width: 1900px){
    .div-right-content p {
        font-size: 130%;
    }
    .title-ponto {
        font-size: 100%;
    }
}
@media (min-width: 1901px) {

    #form-title {
        font-size: 130%;
    }
}
.form input {
    font-size: 80%;
}
.form label {
    font-size: 80%;
}
.button-primary {
    color: #ffffff;
    border: none;
    background-color: #242424;
    transition: 1s;
}
.button-primary:hover {
    color: white;
    background-color: #000000;
}
@media (min-width: 1901px) {
    .form input {
        font-size: 100%;
    }
    .form label {
        font-size: 100%;
    }
}
.link-text-login {
    color: #000000;
    text-decoration: underline;
    transition: 0.5s;
}
.link-text-login:hover {
    color: #242424;
}
</style>
