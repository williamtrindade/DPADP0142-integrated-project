<template>
    <div class="list-employees full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Solicitações de ponto</h1>
            <div class="p-3">
                <div class="card-data">
                    <div class="card">
                        <div class="card-header">
                            Listagem de solicitações de ponto
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Data / Hora</th>
                                        <th scope="col">Usuário</th>
                                        <th scope="col">Usuário / Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pointRecord in pointRecords" v-bind:key="pointRecord.id">
                                        <td>{{ pointRecord.id }}</td>
                                        <td>{{ getFormatedDate(pointRecord.created_at) }}</td>
                                        <td>{{ pointRecord.user.name }}</td>
                                        <td>{{ pointRecord.user.email }}</td>
                                        <td>{{ pointRecord.status }}</td>
                                        <td>{{ (pointRecord.type === '1') ? 'Entrada' : 'Saída' }}</td>
                                        <td>
                                            <ListViewButton
                                                icon="fas fa-check"
                                                v-on:click.native="approve(pointRecord.id)"
                                            >
                                            </ListViewButton>
                                            <ListDeleteButton
                                                icon="fas fa-ban"
                                                v-on:click.native="unapprove(pointRecord.id)"
                                            >
                                            </ListDeleteButton>
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
</template>

<script>
import ManagerSidebar from '@/components/manager/ManagerSidebar'
import ManagerTopbar from '@/components/manager/ManagerTopbar'
import ListViewButton from '@/components/ListViewButton'
import PointRecordService from '@/services/PointRecordService'
import ListDeleteButton from '@/components/ListDeleteButton'
import NotificationService from '@/services/NotificationService'

export default {
    name: 'ListPointRecordRequests',
    data () {
        return {
            pointRecords: null
        }
    },
    components: {
        ListDeleteButton,
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        ListViewButton
    },
    mounted () {
        PointRecordService.getAllUnapproved()
            .then((pointRecords) => {
                this.pointRecords = pointRecords
            })
    },
    methods: {
        getFormatedDate (date) {
            console.log(date)
            const data = new Date(date)
            const day = data.getDate()
            const month = data.getMonth()
            const year = data.getFullYear()
            const hour = data.getHours()
            const minute = data.getMinutes()

            return `${day}/${month}/${year} - ${hour}:${minute}`
        },
        approve (id) {
            PointRecordService.approve(id)
                .then(() => {
                    NotificationService.success('Aprovado com sucesso!')
                    this.$router.push({ name: 'manager-dash' })
                })
        },
        unapprove (id) {
            PointRecordService.unapprove(id)
                .then(() => {
                    NotificationService.success('Reprovado com sucesso!')
                    this.$router.push({ name: 'manager-dash' })
                })
        }
    }
}
</script>

<style scoped>
</style>
