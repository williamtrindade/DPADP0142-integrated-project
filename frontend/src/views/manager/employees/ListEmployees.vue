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
                                    v-model="searchText"
                                    v-on:keyup="search"
                                    type="text"
                                    class="form-control"
                                    placeholder="Pesquisar nome"
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Permissão</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users" v-bind:key="user.id">
                                        <th>{{ user.name }}</th>
                                        <td>{{ user.email }}</td>
                                        <td>{{ (user.phone != null) ? user.phone : 'Telefone não informado'  }}</td>
                                        <td>{{ (user.permission === '1') ? 'Gerente': 'Empregado'  }}</td>
                                        <td>
                                            <view-button
                                                icon="far fa-eye"
                                                v-on:click.native="viewUser(user.id)"
                                            >
                                            </view-button>
                                            <delete-button
                                                icon="far fa-trash-alt"
                                                v-on:click.native="deleteUser(user.id)"
                                            ></delete-button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                            <!-- <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ManagerSidebar from '@/components/manager/ManagerSidebar'
import ManagerTopbar from '@/components/manager/ManagerTopbar'
import Button from '@/components/Button'
import UserService from '@/services/UserService'
import ListDeleteButton from '@/components/ListDeleteButton'
import ListViewButton from '@/components/ListViewButton'

export default {
    name: 'ListEmployees',
    data () {
        return { users: null, searchText: null }
    },
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        'button-component': Button,
        'delete-button': ListDeleteButton,
        'view-button': ListViewButton
    },
    mounted () {
        UserService.getAll('?permission=2')
            .then((users) => {
                if (users) {
                    this.users = users
                }
            })
    },
    methods: {
        viewUser (id) {
            this.$router.push({ name: 'manager-view-employee', params: { id: id } })
        },
        deleteUser (id) {
            UserService.delete(id)
            UserService.getAll('?permission=2')
                .then((users) => {
                    if (users) {
                        this.users = users
                    }
                })
        },
        async search () {
            this.users = await UserService
                .getAll('?permission=2&name=' + this.searchText)
        }
    }
}
</script>

<style scoped>
</style>
