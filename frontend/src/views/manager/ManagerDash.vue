<template>
    <div class="manager-dash">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Dashboard</h1>
            <div class="row m-0 p-0 justify-content-center">
                <div class="col-md-6 p-3 m-0">
                    <div class="card">
                        <div class="card-header">
                            Entrada de novos colaboradores
                        </div>
                        <div class="card-body">
                            <h1>{{  newEmployees }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-3 m-0">
                    <div class="card">
                        <div class="card-header">
                            Gráfico
                        </div>
                        <div class="card-body">
                            <NewEmployeesChart></NewEmployeesChart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NewEmployeesChart from '@/views/manager/charts/NewEmployeesChart'
import ManagerSidebar from '@/components/manager/ManagerSidebar'
import ManagerTopbar from '@/components/manager/ManagerTopbar'
import ReportsService from '@/services/ReportsService'

export default {
    name: 'ManagerDash',
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        NewEmployeesChart
    },
    mounted () {
        this.getNewEmployeesTotal()
    },
    data () {
        return {
            newEmployees: null
        }
    },
    methods: {
        getNewEmployeesTotal () {
            ReportsService.getAll()
                .then((resp) => {
                    this.newEmployees = resp.new_employees_total
                })
        }
    }
}
</script>

<style scoped>
.manager-dash {
    float: left;
    width: 100%;
    height: 100%;
}
</style>
