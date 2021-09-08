<template>
    <div class="list-point-records">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Registro de pontos</h1>
            <div class="p-3">
                <div class="row">
                    <div class="col-md-12 mb-3" style="text-align: right;">
                        <router-link
                            :to="{ name:'employee-create-point-records' }"
                        >
                            <button-component
                                content="Bater Ponto"
                            >
                            </button-component>
                        </router-link>
                    </div>
                </div>
                <div class="card-data">
                    <div class="card">
                        <div class="card-header">
                            Listagem de registro de pontos
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Data / Hora</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pointRecord in pointRecords" v-bind:key="pointRecord.id">
                                        <td>{{ pointRecord.id }}</td>
                                        <td>{{ getFormatedDate(pointRecord.created_at) }}</td>
                                        <td>{{ getStatus(pointRecord.status) }}</td>
                                        <td>{{ (pointRecord.type === '1') ? 'Entrada' : 'Saída' }}</td>
                                        <td>
                                            <!--                                            <ListViewButton-->
                                            <!--                                                icon="far fa-eye"-->
                                            <!--                                                v-on:click.native="viewUser(user.id)"-->
                                            <!--                                            >-->
                                            <!--                                            </ListViewButton>-->
                                            <!--                                            <ListEditButton-->
                                            <!--                                                icon="far fa-edit"-->
                                            <!--                                                v-on:click.native="editUser(user.id)"-->
                                            <!--                                            >-->
                                            <!--                                            </ListEditButton>-->
                                            <!--                                            <ListDeleteButton-->
                                            <!--                                                icon="far fa-trash-alt"-->
                                            <!--                                                v-on:click.native="deleteUser(user.id)"-->
                                            <!--                                            >-->
                                            <!--                                            </ListDeleteButton>-->
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
import ButtonComponent from '@/components/SendButton'
import EmployeeSidebar from '@/components/employee/EmployeeSidebar'
import EmployeeTopbar from '@/components/employee/EmployeeTopbar'
import PointRecordService from '@/services/PointRecordService'

export default {
    name: 'ListPointRecords',
    data () {
        return {
            pointRecords: null
        }
    },
    components: {
        sidebar: EmployeeSidebar,
        topbar: EmployeeTopbar,
        'button-component': ButtonComponent
    },
    mounted () {
        PointRecordService.getAll()
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
        getStatus (status) {
            let res = null
            switch (status) {
                case '1':
                    res = 'Aprovado'
                    break
                case '2':
                    res = 'Em análise'
                    break
                case '3':
                    res = 'Reprovado'
                    break
            }
            console.log(res)
            return res
        }
    }
}
</script>

<style scoped>

</style>
