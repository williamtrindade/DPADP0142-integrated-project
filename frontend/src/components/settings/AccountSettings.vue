<template>
    <div class="account-settings">
        <div class="card m-3">
            <div class="card-header">
                Dados da conta
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="save">
                    <div class="form-group">
                        <label for="account-name">Nome da empresa</label>
                        <input
                            required
                            minlength="3"
                            maxlength="255"
                            v-model="account.name"
                            type="text"
                            class="form-control"
                            id="account-name"
                            placeholder="Digite o nome da empresa."
                        />
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="account-cnpj">CNPJ</label>
                                <the-mask
                                    :masked="false"
                                    :mask="['##.###.###/####-##']"
                                    required
                                    v-model="account.cnpj"
                                    class="form-control"
                                    id="account-cnpj"
                                    placeholder="99.999.999/9999-99"
                                />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="account-phone">Telefone</label>
                                <the-mask
                                    :mask="['+ ## (##) ####-####', '+ ## (##) #####-####']"
                                    :masked="false"
                                    required
                                    minlength="20"
                                    maxlength="20"
                                    class="form-control"
                                    placeholder="+99 (99) 99999-9999"
                                    v-model="account.phone"
                                    id="account-phone"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account-cep">CEP</label>
                                <the-mask
                                    :masked="false"
                                    :mask="['#####-###']"
                                    required
                                    v-model="account.cep"
                                    class="form-control"
                                    id="account-dep"
                                    placeholder="99999-999"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account-address">Edereço</label>
                                <input
                                    type="text"
                                    minlength="3"
                                    maxlength="255"
                                    v-model="account.address"
                                    class="form-control"
                                    id="account-address"
                                    placeholder="Endereço"
                                />
                            </div>
                        </div>
                    </div>
                    <SendButton
                        :disabled="submitted"
                        content="Salvar"
                    >
                    </SendButton>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import AccountService from '@/services/AccountService'
import SendButton from '@/components/SendButton'
import NotificationService from '@/services/NotificationService'

export default {
    name: 'AccountSettings',
    data () {
        return {
            account: {
                name: null,
                cnpj: null,
                phone: null,
                cep: null,
                address: null
            },
            submitted: false
        }
    },
    components: {
        SendButton
    },
    mounted () {
        AccountService.get()
            .then((account) => {
                this.account = account
            })
    },
    methods: {
        save () {
            this.submitted = true
            AccountService.update(this.account)
                .then((account) => {
                    NotificationService.success('Dados alterados com sucesso!')
                    this.submitted = false
                }).catch(() => {
                    this.submitted = false
                })
        }
    }
}
</script>

<style scoped>
</style>
