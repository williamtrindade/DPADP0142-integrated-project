<template>
    <div class="settings">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="p-3">Meus dados</h1>

            <div class="card-data p-4">
                <div class="card">
                    <div class="card-header">
                        Dados Pessoais
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="savePersonalData">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input
                                            min="3"
                                            max="250"
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            placeholder="Digite seu nome"
                                            required
                                            v-model="name"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Endereço de email</label>
                                        <input
                                            required
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            placeholder="Digite seu email."
                                            v-model="email"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="pass">Senha</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="pass"
                                            placeholder="Digite sua senha."
                                            v-model="password"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                </div>
                            </div>

                            <div class="row justify-content-between buttons">
                                <div class="col-md-6 col-sm-12">
                                    <button
                                        id="send-personal-data-button"
                                        type="submit"
                                        class="btn button-primary pl-3 pr-3 mr-3 "
                                        style="color:#434343">
                                        <i class="fas fa-check"></i>
                                        Salvar dados pessoais
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--            <div class="card-data pl-4 pr-4">-->
            <!--                <div class="card">-->
            <!--                    <div class="card-header">-->
            <!--                        Dados Pessoais-->
            <!--                    </div>-->
            <!--                    <div class="card-body">-->
            <!--                        <form v-on:submit.prevent="login">-->

            <!--                            <div class="row">-->
            <!--                                <div class="col-md-6 col-sm-12">-->
            <!--                                    <div class="form-group">-->
            <!--                                        <label for="email">Endereço de email</label>-->
            <!--                                        <input-->
            <!--                                            required-->
            <!--                                            v-model="email"-->
            <!--                                            type="email"-->
            <!--                                            class="form-control"-->
            <!--                                            id="email"-->
            <!--                                            placeholder="Digite seu email."-->
            <!--                                        />-->
            <!--                                    </div>-->
            <!--                                </div>-->
            <!--                                <div class="col-md-6 col-sm-12">-->
            <!--                                    <div class="form-group">-->
            <!--                                        <label for="email">Endereço de email</label>-->
            <!--                                        <input-->
            <!--                                            required-->
            <!--                                            v-model="email"-->
            <!--                                            type="email"-->
            <!--                                            class="form-control"-->
            <!--                                            id="email"-->
            <!--                                            placeholder="Digite seu email."-->
            <!--                                        />-->
            <!--                                    </div>-->
            <!--                                </div>-->
            <!--                            </div>-->

            <!--                            <div class="row">-->
            <!--                                <div class="col-md-6 col-sm-12">-->
            <!--                                    <div class="form-group">-->
            <!--                                        <label for="pass">Senha</label>-->
            <!--                                        <input-->
            <!--                                            required-->
            <!--                                            v-model="password"-->
            <!--                                            type="password"-->
            <!--                                            class="form-control"-->
            <!--                                            id="pass"-->
            <!--                                            placeholder="Digite sua senha."-->
            <!--                                        />-->
            <!--                                    </div>-->
            <!--                                </div>-->
            <!--                                <div class="col-md-6 col-sm-12">-->
            <!--                                </div>-->
            <!--                            </div>-->

            <!--                            <div class="row justify-content-between buttons">-->
            <!--                                <div class="col-md-6 col-sm-12">-->
            <!--                                    <button-->
            <!--                                        id="send-button"-->
            <!--                                        type="submit"-->
            <!--                                        class="btn button-primary pl-3 pr-3 mr-3 "-->
            <!--                                        style="color:#434343"><i class="fas fa-check"></i> Salvar dados da conta-->
            <!--                                    </button>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </form>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="row">-->
            <!--                    <div class="pt-4 col-md-12">-->
            <!--                        <router-link-->
            <!--                            style="color:#434343;"-->
            <!--                            class="btn button-secondary pl-5 pr-5"-->
            <!--                            to="register">-->
            <!--                            Voltar-->
            <!--                        </router-link>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </div>
</template>

<script>
import Sidebar from '@/components/manager/Sidebar'
import Topbar from '@/components/manager/Topbar'
import UserService from '../../../services/UserService'
import NotificationService from '../../../services/NotificationService'

export default {
    name: 'UserSettings',
    data () {
        return {
            name: null,
            email: null,
            password: null,
            permission: null
        }
    },
    components: {
        sidebar: Sidebar,
        topbar: Topbar
    },
    async mounted () {
        const data = await UserService.get()
        this.name = data.name
        this.email = data.email
        this.permission = data.permission
    },
    methods: {
        async savePersonalData () {
            this.blockSendPersonalDataButton()
            const data = await UserService.update(this.name, this.email, this.password)
            if (data !== false) {
                this.name = data.name
                this.email = data.email
            }
            this.unblockSendPersonalDataButton()
            NotificationService.success('Dados alterados!')
        },
        blockSendPersonalDataButton () {
            document.querySelector('#send-personal-data-button').disabled = true
        },
        unblockSendPersonalDataButton () {
            document.querySelector('#send-personal-data-button').disabled = false
        }
    }
}
</script>

<style scoped>
h1 {
    background-color: rgb(0, 0, 0);
    color: white;
    font-size: 130%;
    text-align: left;
}
.card-data {
}
.button-primary {
    background-color: #00ff9d;
    border:#00ff9d 2px solid;
}
.button-secondary {
    border: 1px solid #000;
    background-color: #ffffff;
}
.button-primary:hover {
    background-color: #5dffbd;
}
.button-primary:current {
    background-color: #5dffbd;
}
@media (max-width: 900px) {
    .buttons {
        justify-content: center;
        align-items: center;
        text-align: center;
    }
}
</style>
