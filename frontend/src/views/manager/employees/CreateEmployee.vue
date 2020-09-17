<template>
    <div class="create-employees full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Adicionar Empregado</h1>
        </div>
    </div>
</template>

<script>
import Sidebar from '@/components/manager/Sidebar'
import Topbar from '@/components/manager/Topbar'
// import Button from '@/components/Button'

export default {
    name: 'CreateEmployee',
    components: {
        sidebar: Sidebar,
        topbar: Topbar
    }
}
</script>

<style scoped>
</style>
