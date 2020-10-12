<template>
    <div class="manager-settings">
        <ManagerSidebar></ManagerSidebar>
        <ManagerTopbar></ManagerTopbar>
        <div class="content">
            <h1 class="title-black">Configurações</h1>
            <UserSettings></UserSettings>
            <AccountSettings></AccountSettings>
        </div>
    </div>
</template>

<script>
import ManagerSidebar from '@/components/manager/ManagerSidebar'
import ManagerTopbar from '@/components/manager/ManagerTopbar'
import UserSettings from '@/components/settings/UserSettings'
import AccountSettings from '@/components/settings/AccountSettings'

export default {
    name: 'ManagerSettings',
    components: {
        ManagerSidebar,
        ManagerTopbar,
        UserSettings,
        AccountSettings
    }
}
</script>

<style scoped>
</style>
