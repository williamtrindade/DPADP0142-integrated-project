<template>
    <div class="settings full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Visualizar colaborador</h1>

            <div class="card-data p-3">
                <button-component
                    class="mb-3"
                    content="Voltar"
                    v-on:click.native="$router.go(-1)"
                    icon="fas fa-arrow-left"
                >
                </button-component>

                <div class="card">
                    <div class="card-header">
                        Dados Pessoais
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 m-3">
                                <div class="row">
                                    <h1>{{user.name}}</h1>
                                </div>
                                <div class="row">
                                    <p><b>Email: </b>{{user.email}}</p>
                                </div>
                                <div class="row">
                                    <p><b>Permissão: </b> {{user.permission}}</p>
                                </div>
                                <div class="row" v-if="user.address">
                                    <p><b>Endereço: </b>{{user.address}}</p>
                                </div>
                                <div class="row" v-if="user.phone">
                                    <p><b>Telefone: </b>{{user.phone}}</p>
                                </div>
                                <div class="row" v-if="user.cpf">
                                    <p><b>CPF: </b>{{user.cpf}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ManagerSidebar from '@/components/manager/ManagerSidebar'
import ManagerTopbar from '@/components/manager/ManagerTopbar'
import UserService from '@/services/UserService'
import Button from '@/components/Button'

export default {
    name: 'ViewEmployee',
    data () {
        return {
            user: {
                name: null,
                email: null,
                permission: null,
                address: null,
                phone: null,
                cpf: null
            }
        }
    },
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        'button-component': Button
    },
    mounted () {
        if (this.$route.params.id) {
            UserService.getUser(this.$route.params.id)
                .then((user) => {
                    this.user = {
                        name: user.name,
                        email: user.email,
                        permission: user.permission === '1' ? 'Gerente' : 'Colaborador',
                        address: user.address,
                        phone: user.phone,
                        cpf: user.cpf
                    }
                }).catch(() => {
                    this.$router.push({ name: 'not-found' })
                })
        } else {
            this.$router.push({ name: 'not-found' })
        }
    }
}
</script>

<style>

</style>
