<template>
    <div class="employee-register">
        <div class="manager-sidebar">
            <a style="font-size:250%; padding-top:6px;background-color:#00ff9d;color:#000;border:0" href="#"
            > .P
            </a>
        </div>
        <div class="topbar">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">.Ponto web</a>
            </nav>
        </div>
        <div class="content">
            <h1 class="title-black">Finalizar Cadastro</h1>
            <h2 class="subtitle ml-3 mt-4">Bem-vindo ao ponto! Finalize seu cadastro ;)</h2>
            <div class="m-3 card-data">
                <div class="card">
                    <div class="card-header">
                        Formulário de cadastro
                    </div>
                    <div class="card-body">
                        <form
                            v-on:submit.prevent="createUser"
                        >
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input
                                    required
                                    placeholder="Digite seu nome"
                                    minlength="3"
                                    maxlength="255"
                                    v-model="name"
                                    type="text"
                                    class="form-control"
                                    id="name"
                                >
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    placeholder="Digite seu email para entrar no sistema"
                                    minlength="3"
                                    maxlength="255"
                                    required
                                    v-model="email"
                                    type="email"
                                    class="form-control"
                                    id="email"
                                >
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input
                                    placeholder="Crie sua senha de no minimo 6 digitos"
                                    minlength="6"
                                    maxlength="500"
                                    required
                                    v-model="password"
                                    type="password"
                                    class="form-control"
                                    id="password"
                                >
                            </div>
                            <button-component
                                ref="button"
                                content="Finalizar meu cadastro"
                                icon="fas fa-check"
                            >
                            </button-component>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Button from '@/components/Button'
import EmployeeInvitationService from '@/services/EmployeeInvitationService'
import UserService from '@/services/UserService'
import NotificationService from '@/services/NotificationService'

export default {
    name: 'EmployeeRegister',
    data: function () {
        return {
            name: null,
            email: null,
            password: null,
            hash: null
        }
    },
    mounted () {
        if (this.$route.query.hash && this.$route.query.email) {
            EmployeeInvitationService.validateHash(this.$route.query.hash)
                .then((resp) => {
                    if (resp.status !== 200) {
                        this.$router.push({ name: 'login' })
                    }
                    this.hash = this.$route.query.hash
                    this.email = this.$route.query.email
                })
        } else {
            this.$router.push({ name: 'login' })
        }
    },
    components: {
        'button-component': Button
    },
    methods: {
        createUser () {
            this.$refs.button.$el.firstChild.disabled = true
            UserService.createByHash(this.name, this.email, this.password, this.hash)
                .then((resp) => {
                    if (resp.status === 201) {
                        NotificationService.success('Bem vindo, faça seu login agora!')
                        this.$router.push({ name: 'login' })
                    }
                    this.$refs.button.$el.firstChild.disabled = false
                }).catch(() => {
                    this.$refs.button.$el.firstChild.disabled = false
                })
        }
    }
}
</script>

<style scoped>
.subtitle {
    font-size: 150%;
}
.manager-sidebar {
    background-color: rgb(0, 0, 0);
    position: fixed;
    float: left;
    height: 100%;
    width:70px;
}
.manager-sidebar a {
    padding-top: 20px;
    text-align: center;
    justify-content: center;
    color: #ffffff;
    text-decoration: none;
    font-size: 140%;
    width: 100%;
    float:left;
    max-width: 100%;
}
.manager-sidebar a i {
    font-size: 200%;
    width: 100%;
    height: 100%;
    float:left;
    max-width: 100%;
}
.manager-sidebar a:hover {
    transition: 0.5s;
    text-decoration: none;
    color: #fff;
    background-color: rgb(68, 68, 68)
}
.topbar {
    z-index: 1;
    border-bottom: rgb(0, 0, 0) 4px solid;
    height: 70px;
    padding-left: 70px;
    position: fixed;
    float: left;
    width: 100%;
}
.navbar {
    height: 100%;
    float: left;
    width: 100%;
}
</style>
