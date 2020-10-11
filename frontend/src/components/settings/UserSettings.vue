<template>
    <div class="user-settings">
        <div class="card m-3">
            <div class="card-header">
                Dados Pessoais
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="save">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="user-name">Nome</label>
                                <input
                                    required
                                    min="3"
                                    max="255"
                                    type="text"
                                    class="form-control"
                                    id="user-name"
                                    placeholder="Digite seu nome."
                                    v-model="user.name"
                                />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="user-email">Endereço de email</label>
                                <input
                                    required
                                    minlength="3"
                                    maxlength="255"
                                    type="email"
                                    class="form-control"
                                    id="user-email"
                                    placeholder="Digite seu email."
                                    v-model="user.email"
                                />
                            </div>
                        </div>
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
                                    class="form-control"
                                    placeholder="999.999.999-99"
                                    v-model="user.cpf"
                                    id="cpf"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-phone">Telefone</label>
                                <the-mask
                                    :mask="['+ ## (##) ####-####', '+ ## (##) #####-####']"
                                    :masked="false"
                                    required
                                    minlength="20"
                                    maxlength="20"
                                    class="form-control"
                                    placeholder="+99 (99) 99999-9999"
                                    v-model="user.phone"
                                    id="user-phone"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="pass">Senha</label>
                                <input
                                    minlength="3"
                                    maxlength="500"
                                    type="password"
                                    class="form-control"
                                    id="pass"
                                    placeholder="Digite sua senha."
                                    v-model="user.password"
                                />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="permission">Permissão</label>
                                <input
                                    disabled
                                    type="text"
                                    v-model="permission"
                                    class="form-control"
                                    id="permission"
                                />
                            </div>
                        </div>
                    </div>
                    <SendButton
                        :disabled="this.$store.isMakingRequest"
                        content="Salvar"
                    >
                    </SendButton>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import SendButton from '@/components/SendButton'
import UserService from '@/services/UserService'
import NotificationService from '@/services/NotificationService'

export default {
    name: 'UserSettings',
    data () {
        return {
            user: {
                name: null,
                email: null,
                phone: null,
                password: null,
                permission: null
            },
            permission: null,
            submitted: false
        }
    },
    components: {
        SendButton
    },
    mounted () {
        UserService.getMe()
            .then((user) => {
                this.user = user
                this.permission = user.permission === '1' ? 'Gerente' : 'Colabadorador'
            })
    },
    methods: {
        save () {
            this.submitted = true
            UserService.updateMe(this.user)
                .then((user) => {
                    NotificationService.success('Dados do usuário alterados!')
                    this.submitted = false
                })
                .catch(() => {
                    this.submitted = false
                })
        }
    }
}
</script>

<style scoped>
</style>
