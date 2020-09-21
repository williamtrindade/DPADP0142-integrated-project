<template>
    <div class="register">
        <div class="register-left align-middle">
            <div class="div-left-content shadow-lg bg-white">
                <h1 style="text-align: center" class="title-ponto">.Ponto</h1>
                <hr>
                <h2 id="form-title">Cadastre-se</h2>
                <hr>
                <form v-on:submit.prevent="register" class="form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name">Nome</label>
                                <input
                                    required
                                    minlength="3"
                                    maxlength="255"
                                    v-model="user_name"
                                    type="text"
                                    class="form-control"
                                    id="user-name"
                                    placeholder="Seu nome"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Endereço de email</label>
                                <input
                                    required
                                    minlength="3"
                                    maxlength="255"
                                    v-model="user_email"
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    placeholder="Seu e-mail"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="account-name">Nome da empresa</label>
                        <input
                            required
                            minlength="3"
                            maxlength="255"
                            v-model="account_name"
                            type="text"
                            class="form-control"
                            id="account-name"
                            placeholder="Nome da sua empresa"
                        />
                    </div>

                    <div class="form-group">
                        <label for="user-password">Senha</label>
                        <input
                            required
                            minlength="6"
                            maxlength="500"
                            v-model="user_password"
                            type="password"
                            class="form-control"
                            id="user-password"
                            placeholder="Sua nova senha"
                        />
                    </div>
                    <div class="form-group">
                        <label for="account-cnpj">CNPJ</label>
                        <input
                            required
                            minlength="14"
                            maxlength="18"
                            v-model="account_cnpj"
                            type="text"
                            class="form-control"
                            id="account-cnpj"
                            placeholder="CNPJ da empresa"
                        />
                    </div>

                    <div class="form-group">
                        <label for="account-phone">Telefone/Celular</label>
                        <input
                            required
                            minlength="8"
                            maxlength="15"
                            v-model="account_phone"
                            type="text"
                            class="form-control"
                            id="account-phone"
                            placeholder="+99 99 99999-9999"
                        />
                    </div>

                    <div class="justify-content-start float-left full-width" style="text-align: left;">
                        <button
                            id="send-button"
                            type="submit"
                            class="btn button-primary pl-5 pr-5 "
                            style="border: none;">{{ this.registerButtonText }}
                        </button>
                        <router-link to="login">
                            <a href="#" class="link-text-register pl-3 pt-1">Já tenho conta!</a>
                        </router-link>
                    </div>
                </form>
            </div>
        </div>

        <div class="register-right">
        </div>
    </div>
</template>

<script>

import AccountService from '@/services/AccountService'
import NotificationService from '@/services/NotificationService'

export default {
    name: 'Register',
    data () {
        return {
            registerButtonText: 'Finalizar cadastro',
            user_name: null,
            user_email: null,
            account_name: null,
            user_password: null,
            account_cnpj: null,
            account_phone: null
        }
    },
    methods: {
        async register () {
            this.blockSendButton()
            this.registerButtonText = 'Enviando dados...'
            const data = await AccountService.create(
                this.user_name,
                this.user_email,
                this.account_name,
                this.user_password,
                this.account_cnpj,
                this.account_phone)
            if (data === true) {
                NotificationService.success('Bem vindo, faça seu login agora!')
                await this.$router.push({ name: 'login' })
            }
            this.registerButtonText = 'Reenviar dados'
            this.unblockSendButton()
        },
        blockSendButton () {
            document.querySelector('#send-button').disabled = true
        },
        unblockSendButton () {
            document.querySelector('#send-button').disabled = false
        }
    },
    mounted () {
        if (localStorage.getItem('access_token')) {
            this.$router.push({ name: 'home' })
        }
    }
}
</script>

<style scoped>
.register {
    width: 100%;
    height: 100%;
}
.div-left-content {
    padding: 5%;
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
#form-title {
    font-size: 150%;
}
.register-left {
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
.register-right {
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
.link-text-register {
    color: #000000;
    text-decoration: underline;
    transition: 0.5s;
}
.link-text-register:hover {
    color: #242424;
}
.div-right-content p {
    font-family: 'Signika Negative', sans-serif;
    color: #ffffff;
    font-size: 200%;
}
#form-title {
    font-size: 100%;
}
.form input {
    font-size: 80%;
}
.form label {
    font-size: 80%;
}
@media (max-width: 575.98px)  {
    .register-left {
        width: 100%;
    }
    .div-left-content {
        width: 90%;
    }
    .register-right {
        display: none;
    }
}
@media (min-width: 576px) and (max-width: 767.98px) {
    .div-left-content {
        width: 90%;
    }
    .register-left {
        width: 100%;
    }
    .register-right {
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
    .form input {
        font-size: 100%;
    }
    .form label {
        font-size: 100%;
    }
}
</style>
