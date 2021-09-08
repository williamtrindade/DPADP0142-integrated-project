<template>
    <div class="employee-dash">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Dashboard</h1>
            <div class="row m-0 p-0 justify-content-center">
                <div class="col-md-12 p-3 m-0">
                    <div class="card">
                        <div class="card-header">
                            Total de horas trabalhadas
                        </div>
                        <div class="card-body">
                            <h1>10</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-3 m-0">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import EmployeeSidebar from '@/components/employee/EmployeeSidebar'
import EmployeeTopbar from '@/components/employee/EmployeeTopbar'
export default {
    name: 'EmployeeDash',
    components: {
        sidebar: EmployeeSidebar,
        topbar: EmployeeTopbar
    }
}
</script>

<style scoped>
</style>
