<template>
    <div class="list-point-records">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Registro de pontos</h1>
        </div>
    </div>
</template>

<script>
import EmployeeSidebar from '@/components/employee/EmployeeSidebar'
import EmployeeTopbar from '@/components/employee/EmployeeTopbar'

export default {
    name: 'ListPointRecords',
    components: {
        sidebar: EmployeeSidebar,
        topbar: EmployeeTopbar
    }
}
</script>

<style scoped>

</style>
