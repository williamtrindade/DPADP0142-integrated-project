<template>
    <div class="list-working-hours full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Jornadas de trabalho</h1>
            <div class="p-3">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-12 mb-3" style="text-align: right;">
                            <router-link
                                :to="{ name:'manager-create-working-hours' }"
                            >
                                <button-component
                                    content="Adicionar"
                                    icon="fas fa-plus"
                                >
                                </button-component>
                            </router-link>
                        </div>
                    </div>
                    <div class="card-data">
                        <div class="card">
                            <div class="card-header">
                                Listagem de jornadas de trabalho
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Descrição</th>
                                            <th scope="col">Quantidade de blocos</th>
                                            <th scope="col">Total de horas</th>
                                            <th scope="col">Ativa em</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr v-for="user in users" v-bind:key="user.id">
                                            <th>{{ user.name }} </th>
                                            <td>{{ user.email }}</td>
                                            <td>{{ (user.phone != null) ? user.phone : 'Telefone não informado'  }}</td>
                                            <td>{{ (user.permission === '1') ? 'Gerente': 'Colaborador'  }}</td>
                                            <td>
                                                <view-button
                                                    icon="far fa-eye"
                                                    v-on:click.native="viewUser(user.id)"
                                                >
                                                </view-button>
                                                <delete-button
                                                    icon="far fa-trash-alt"
                                                    v-on:click.native="deleteUser(user.id)"
                                                >
                                                </delete-button>
                                            </td>

                                        </tr> -->
                                    </tbody>
                                </table>
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
import ButtonComponent from '@/components/Button'

export default {
    name: 'ListWorkingHours',
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        'button-component': ButtonComponent
    }
}
</script>

<style scoped>
</style>
