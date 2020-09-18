<template>
    <div class="list-employees full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Empregados</h1>
            <div class="p-3">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Pesquisar"
                                >
                                <router-link :to="{ name:'manager-create-employees' }">
                                    <button-component class="ml-2" content="Adicionar" icon="fas fa-plus"></button-component>
                                </router-link>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-data">
                    <div class="card">
                        <div class="card-header">
                            Listagem de empregados
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
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
import Sidebar from '@/components/manager/Sidebar'
import Topbar from '@/components/manager/Topbar'
import Button from '@/components/Button'
export default {
    name: 'ListEmployees',
    components: {
        sidebar: Sidebar,
        topbar: Topbar,
        'button-component': Button
    }
}
</script>

<style scoped>
</style>
