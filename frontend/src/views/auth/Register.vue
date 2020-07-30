<template>
    <div class="login full-height float-left full-width">
        <div class="row text-left full-width full-height">
            <div class="col-md-6 login-left">
                <h1>
                    Bem-vindo ao .Ponto
                </h1>
                <hr>
                <h2 id="form-title">Faça seu registo na plataforma</h2>
                <hr>
                <form v-on:submit.prevent="login">
                    <div class="form-group">
                        <label for="user-name">Nome</label>
                        <input
                            required
                            v-model="user_name"
                            type="text"
                            class="form-control"
                            id="user-name"
                            placeholder="Seu nome"
                        />
                    </div>

                    <div class="form-group">
                        <label for="email">Endereço de email</label>
                        <input
                            required
                            v-model="user_email"
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Seu e-mail"
                        />
                    </div>

                    <div class="form-group">
                        <label for="account-name">Nome da empresa</label>
                        <input
                            required
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
                            v-model="account_cnpj"
                            type="text"
                            class="form-control"
                            id="account-cnpj"
                            placeholder="CNPJ da empresa"
                        />
                    </div>
                    <div class="justify-content-start float-left full-width" style="text-align: left;">
                        <button
                            type="submit"
                            class="btn btn-primary button-primary pl-5 pr-5 "
                            style="color:#000;border: none;">{{ this.registerButtonText }}
                        </button>
                        <router-link to="login">
                            <a href="#" class="link-text pl-3 pt-1">Já tenho conta!</a>
                        </router-link>
                    </div>
                </form>
            </div>

            <div class="col-md-6 login-right">
                <img src="../../assets/img/office.svg" alt="IMG">
                <!-- <div class="form-group">
                    <label for="email">Endereço de email</label>
                    <input type="email" class="form-control" id="email">
                </div>

                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass">
                </div>-->

                <!-- <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>-->
            </div>
        </div>
    </div>
</template>

<script>
import AuthService from '../../services/AuthService'

export default {
    name: 'Register',
    data () {
        return {
            registerButtonText: 'Finalizar cadastro',
            user_name: null,
            user_email: null,
            account_name: null,
            user_password: null,
            account_cnpj: null
        }
    },
    methods: {
        async login () {
            if (await AuthService.login(this.email, this.password)) {
                await this.$router.push({ name: 'home' })
            } else {
                alert('Erro de autenticação')
            }
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
    .button-primary {
        background-color: #00ff9d;
    }
    .button-primary:hover {
        background-color: #5dffbd;
    }
    #form-title {
        font-size: 140%;
    }
    .login-left {
        padding-left:10%;
        padding-right: 15%;
        padding-top: 10%;
    }
    .login-right img {
        margin-top: 10%;
        width: 70%;
    }
    .login-left {
        background-color:#2c2c2c;
    }
    .login-left {
        color:#00ff9d;
    }
    .login-right img {
        margin-left: 10%;
        margin-top: 20%;
    }
</style>
