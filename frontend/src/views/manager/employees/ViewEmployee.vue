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
                        <form>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input
                                            required
                                            min="3"
                                            max="255"
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            placeholder="Digite seu nome."
                                            v-model="user.name"
                                            disabled
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Endereço de email</label>
                                        <input
                                            required
                                            minlength="3"
                                            maxlength="255"
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            placeholder="Digite seu email."
                                            v-model="user.email"
                                            disabled
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="permission">Permissão</label>
                                        <input
                                            disabled
                                            type="text"
                                            v-model="user.permission"
                                            class="form-control"
                                            id="permission"
                                        />
                                    </div>
                                </div>
                            </div>
                        </form>
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
                permission: null
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
                        permission: user.permission === '1' ? 'Gerente' : 'Colaborador'
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
