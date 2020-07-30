<template>
    <div class="login full-height float-left full-width">
        <div class="row text-left full-width full-height">
            <div class="col-sm-12 col-md-6  login-left">
                <h1>
                    Bem-vindo ao .Ponto
                </h1>
                <hr>
                <h2 id="form-title">Faça seu login</h2>
                <hr>
                <form v-on:submit.prevent="login">
                    <div class="form-group">
                        <label for="email">Endereço de email</label>
                        <input
                            required
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
                            v-model="password"
                            type="password"
                            class="form-control"
                            id="pass"
                            placeholder="Digite sua senha."
                        />
                    </div>
                    <div class="justify-content-start float-left full-width" style="text-align: left;">
                        <button
                            type="submit"
                            class="btn btn-primary button-primary pl-5 pr-5 "
                            style="color:#000;border: none;">{{ this.loginButtonText }}
                        </button>
                        <router-link to="register">
                            <a href="#" class="link-text pl-3 pt-1" >Ainda não tenho conta!</a>
                        </router-link>
                    </div>
                </form>
            </div>

            <div class="col-xl-0 col-sm-0 col-md-6 login-right">
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
            this.loginButtonText = 'Entrando...'
            if (await AuthService.login(this.email, this.password)) {
                await this.$router.push({ name: 'home' })
            } else {
                this.loginButtonText = 'Entrar'
                confirm('Erro de autenticação, tente novamente')
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
@media (max-width: 767px) {
    .login-right {
        visibility: collapse;
    }
}
</style>
