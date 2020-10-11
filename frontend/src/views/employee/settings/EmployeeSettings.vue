<template>
    <div class="employee-settings">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Configurações</h1>
            <UserSettings></UserSettings>
        </div>
    </div>
</template>

<script>
import EmployeeSidebar from '@/components/employee/EmployeeSidebar'
import EmployeeTopbar from '@/components/employee/EmployeeTopbar'
import UserSettings from '@/components/settings/UserSettings'

export default {
    name: 'EmployeeSettings',
    components: {
        sidebar: EmployeeSidebar,
        topbar: EmployeeTopbar,
        UserSettings
    }
}
</script>

<style scoped>
</style>
