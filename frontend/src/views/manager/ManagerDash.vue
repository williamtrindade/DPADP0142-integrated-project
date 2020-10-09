<template>
    <div class="manager-dash">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Dashboard</h1>
            <div class="row m-0 p-0 justify-content-center float-left">
                <div class="col-md-6 p-3 m-0">
                    <div class="card">
                        <div class="card-header">
                            Entrada de novos colaboradores
                        </div>
                        <div class="card-body">
                            <NewEmployeesChart></NewEmployeesChart>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-3 m-0">
                    <div class="card">
                        <div class="card-header">
                            Featured
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-3 m-0">
                    <div class="card">
                        <div class="card-header">
                            Featured
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-3 m-0">
                    <div class="card">
                        <div class="card-header">
                            Featured
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-3 m-0">
                    <div class="card">
                        <div class="card-header">
                            Featured
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-3 m-0">
                    <div class="card">
                        <div class="card-header">
                            Featured
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
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

export default {
    name: 'ManagerDash',
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        NewEmployeesChart
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
