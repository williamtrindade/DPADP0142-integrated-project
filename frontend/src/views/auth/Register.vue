<template>
    <div class="register">
        <div class="register-left align-middle">
            <div class="div-left-content shadow-lg bg-white pb-3 pt-4">
                <h1 style="text-align: center" class="title-ponto">
                    <img
                        src="https://crmpiperun.com/wp-content/uploads/2019/01/piperun-sistema-crm-vendas.png"
                        alt=""
                        width="150"
                    >
                </h1>
                <hr>
                <form
                    v-on:submit.prevent="register"
                    class="form"
                >
                    <div class="form-group">
                        <label for="user-name">Nome</label>
                        <input
                            required
                            minlength="3"
                            maxlength="255"
                            v-model="user.name"
                            type="text"
                            class="form-control form-control-sm"
                            id="user-name"
                            placeholder="Seu nome completo"
                        />
                    </div>
                    <div class="form-group">
                        <label for="email">Endereço de email</label>
                        <input
                            required
                            minlength="3"
                            maxlength="255"
                            v-model="user.email"
                            type="email"
                            class="form-control form-control-sm"
                            id="email"
                            placeholder="Seu e-mail"
                        />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <the-mask
                                    :mask="['###.###.###-##']"
                                    :masked="false"
                                    required
                                    minlength="14"
                                    class="form-control form-control-sm"
                                    placeholder="999.999.999-99"
                                    v-model="user.cpf"
                                    id="cpf"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Número de telefone</label>
                                <the-mask
                                    :mask="['+ ## (##) ####-####', '+ ## (##) #####-####']"
                                    :masked="false"
                                    required
                                    minlength="20"
                                    maxlength="20"
                                    class="form-control form-control-sm"
                                    placeholder="+99 (99) 99999-9999"
                                    v-model="user.phone"
                                    id="phone"
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
                            v-model="account.name"
                            type="text"
                            class="form-control form-control-sm"
                            id="account-name"
                            placeholder="Nome da sua empresa"
                        />
                    </div>
                    <div class="form-group">
                        <label for="account-cnpj">CNPJ da empresa</label>
                        <the-mask
                            :masked="false"
                            :mask="['##.###.###/####-##']"
                            required
                            v-model="account.cnpj"
                            class="form-control form-control-sm"
                            id="account-cnpj"
                            placeholder="99.999.999/9999-99"
                        />
                    </div>
                    <div class="form-group">
                        <label for="user-password">Senha de acesso</label>
                        <input
                            required
                            minlength="6"
                            maxlength="500"
                            v-model="user.password"
                            type="password"
                            class="form-control form-control-sm"
                            id="user-password"
                            placeholder="Crie uma senha com no minimo 6 caracteres"
                        />
                    </div>

                    <div class="justify-content-start float-left full-width" style="text-align: left;">
                        <SendButton
                            class="pl-5 pr-5"
                            :content="registerButtonText"
                            buttonClass="black"
                        ></SendButton>
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
import SendButton from '@/components/SendButton'

export default {
    name: 'Register',
    data () {
        return {
            registerButtonText: 'Finalizar cadastro',
            user: {
                name: null,
                email: null,
                phone: null,
                password: null
            },
            account: {
                name: null,
                cnpj: null,
                phone: null
            }
        }
    },
    components: {
        SendButton
    },
    methods: {
        register () {
            this.registerButtonText = 'Enviando dados...'
            if (this.user.phone != null) {
                this.account.phone = this.user.phone
            }
            AccountService.create(this.user, this.account)
                .then((data) => {
                    NotificationService.success('Bem vindo, faça seu login agora!')
                    this.$router.push({ name: 'login' })
                })
                .catch(() => {
                    this.registerButtonText = 'Reenviar dados'
                })
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
label {
    font-size: 90%;
}
</style>
