<template>
    <div class="create-employees full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Adicionar Colaborador</h1>

            <div class="m-3 card-data">
                <button-component
                    class="mb-3"
                    content="Voltar"
                    v-on:click.native="$router.go(-1)"
                    icon="fas fa-arrow-left"
                >
                </button-component>
                <div class="card">
                    <div class="card-header">
                        Adicione o colaborador
                    </div>
                    <div class="card-body">
                        <p>Vamos enviar um email para o seu colaborador, digite o email do mesmo abaixo.</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="email"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input
                                v-model="email"
                                type="email"
                                class="form-control"
                                aria-label="Default"
                                aria-describedby="email"
                                required
                            >
                        </div>
                        <button-component
                            ref="button"
                            content="Enviar"
                            :icon="icon"
                            v-on:click.native="sendInvite"
                        >
                        </button-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import ManagerSidebar from '@/components/manager/ManagerSidebar'
import ManagerTopbar from '@/components/manager/ManagerTopbar'
import Button from '@/components/Button'
import NotificationService from '@/services/NotificationService'
import EmployeeInvitationService from '@/services/EmployeeInvitationService'

export default {
    name: 'CreateEmployee',
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        'button-component': Button
    },
    data () {
        return {
            email: null,
            icon: 'fas fa-check'
        }
    },
    methods: {
        sendInvite () {
            this.$refs.button.$el.firstChild.disabled = true
            EmployeeInvitationService.inviteEmployee(this.email)
                .then((resp) => {
                    if (resp.status === 202) {
                        NotificationService.success('Usuário vai ser notificado!')
                    }
                    this.$refs.button.$el.firstChild.disabled = false
                })
                .catch(() => {
                    this.$refs.button.$el.firstChild.disabled = false
                })
        }
    }
}
</script>

<style scoped>
</style>
