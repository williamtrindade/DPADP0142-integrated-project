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
                                        Atualizar dados pessoais
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-data pl-4 pr-4">
                <div class="card">
                    <div class="card-header">
                        Dados da conta
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="saveAccountData">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="account-name">Nome da empresa</label>
                                        <input
                                            required
                                            v-model="accountName"
                                            type="text"
                                            class="form-control"
                                            id="account-name"
                                            placeholder="Digite o nome da empresa."
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="account-phone">Telefone</label>
                                        <input
                                            required
                                            v-model="accountPhone"
                                            type="number"
                                            class="form-control"
                                            id="account-phone"
                                            placeholder="99 9 9999-9999"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="account-cnpj">CNPJ</label>
                                        <input
                                            required
                                            v-model="accountCnpj"
                                            type="text"
                                            class="form-control"
                                            id="account-cnpj"
                                            placeholder="99.999.999/9999-99"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                </div>
                            </div>

                            <div class="row justify-content-between buttons">
                                <div class="col-md-6 col-sm-12">
                                    <button
                                        id="send-account-data-button"
                                        type="submit"
                                        class="btn button-primary pl-3 pr-3 mr-3 "
                                        style="color:#434343"><i class="fas fa-check"></i>
                                        Atualizar dados da conta
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="pt-4 col-md-12">
                        <a
                            v-on:click="back"
                            style="color:#434343;"
                            class="btn button-secondary pl-5 pr-5">Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from '@/components/manager/Sidebar'
import Topbar from '@/components/manager/Topbar'
import UserService from '../../../services/UserService'
import NotificationService from '../../../services/NotificationService'
import AccountService from '../../../services/AccountService'

export default {
    name: 'Settings',
    data () {
        return {
            name: null,
            email: null,
            password: null,
            permission: null,
            accountName: null,
            accountCnpj: null,
            accountPhone: null
        }
    },
    components: {
        sidebar: Sidebar,
        topbar: Topbar
    },
    async mounted () {
        // Get user data
        const data = await UserService.get()
        this.name = data.name
        this.email = data.email
        this.permission = data.permission
        // Get account data
        const accountData = await AccountService.get()
        this.accountName = accountData.name
        this.accountCnpj = accountData.cnpj
        this.accountPhone = accountData.phone
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
        async saveAccountData () {
            this.blockSendAccountDataButton()
            const data = await AccountService.update(this.accountName, this.accountCnpj, this.accountPhone)
            if (data !== false) {
                this.accountName = data.name
                this.accountCnpj = data.cnpj
                this.accountPhone = data.phone
            }
            this.unblockSendAccountDataButton()
            NotificationService.success('Dados alterados!')
        },
        blockSendPersonalDataButton () {
            document.querySelector('#send-personal-data-button').disabled = true
        },
        unblockSendPersonalDataButton () {
            document.querySelector('#send-personal-data-button').disabled = false
        },
        blockSendAccountDataButton () {
            // send-account-data-button
            document.querySelector('#send-account-data-button').disabled = true
        },
        unblockSendAccountDataButton () {
            document.querySelector('#send-account-data-button').disabled = false
        },
        back () {
            this.$router.go(-1)
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
