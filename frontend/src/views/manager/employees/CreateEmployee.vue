<template>
    <div class="create-employees full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Adicionar Empregado</h1>

            <div class="m-3 card-data">
                <div class="card">
                    <div class="card-header">
                        Adicione o empregado
                    </div>
                    <div class="card-body">
                        <p>Vamos enviar um email para o seu colaborador, digite o email do mesmo abaixo.</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="email"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" aria-label="Default" aria-describedby="email">
                        </div>
                        <button-component content="Enviar" icon="fas fa-check"></button-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from '@/components/manager/Sidebar'
import Topbar from '@/components/manager/Topbar'
import Button from '@/components/Button'

export default {
    name: 'CreateEmployee',
    components: {
        sidebar: Sidebar,
        topbar: Topbar,
        'button-component': Button
    }
}
</script>

<style scoped>
</style>
