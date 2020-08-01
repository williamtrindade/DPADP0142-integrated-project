<template>
    <div class="list-employees">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="p-3">Empregados</h1>
        </div>
    </div>
</template>

<script>
import Sidebar from '@/components/manager/Sidebar'
import Topbar from '@/components/manager/Topbar'

export default {
    name: 'ListEmployees',
    components: {
        sidebar: Sidebar,
        topbar: Topbar
    }
}
</script>

<style scoped>
h1 {
    background-color: rgb(0, 0, 0);
    color: white;
    font-size: 130%;
    text-align: left;
}
</style>
