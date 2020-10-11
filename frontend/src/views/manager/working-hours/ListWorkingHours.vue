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
                                        <tr v-for="(working_hour, index) in working_hours" v-bind:key="index">
                                            <th>{{ working_hour.name }} </th>
                                            <td>{{ working_hour.description }}</td>
                                            <td>{{ working_hour.time_blocks.length }}</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>
                                                <edit-button
                                                    icon="far fa-edit"
                                                    v-on:click.native="editWorkingHour(working_hour.id)"
                                                >
                                                </edit-button>
                                                <delete-button
                                                    icon="far fa-trash-alt"
                                                    v-on:click.native="deleteWorkingHour(working_hour.id)"
                                                >
                                                </delete-button>
                                            </td>

                                        </tr>
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
import ButtonComponent from '@/components/SendButton'
import WorkingHourService from '@/services/WorkingHourService'
import ListDeleteButton from '@/components/ListDeleteButton'
import ListEditButton from '@/components/ListEditButton'
import NotificationService from '@/services/NotificationService'

export default {
    name: 'ListWorkingHours',
    data () {
        return {
            working_hours: null
        }
    },
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        'button-component': ButtonComponent,
        'delete-button': ListDeleteButton,
        'edit-button': ListEditButton
    },
    mounted () {
        WorkingHourService.getAll().then((workingHours) => {
            this.working_hours = workingHours
        })
    },
    methods: {
        editWorkingHour (id) {
            this.$router.push({ name: 'manager-edit-working-hours', params: { id: id } })
        },
        deleteWorkingHour (id) {
            WorkingHourService.delete(id)
                .then(() => {
                    NotificationService.success('Carga horária deletada!')
                    WorkingHourService.getAll().then((workingHours) => {
                        this.working_hours = workingHours
                    })
                })
        }
    }
}
</script>

<style scoped>
</style>
