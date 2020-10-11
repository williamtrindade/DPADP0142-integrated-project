<template>
    <div class="list-employees full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Colaboradores</h1>
            <div class="p-3">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input
                                    v-model="searchText"
                                    v-on:keydown="search"
                                    type="text"
                                    class="form-control"
                                    placeholder="Pesquisar nome"
                                >
                                <router-link
                                    :to="{ name:'manager-create-employees' }"
                                >
                                    <SendButton
                                        buttonClass="primary"
                                        class="ml-2"
                                        content="Adicionar"
                                        icon="fas fa-plus"
                                    >
                                    </SendButton>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-data">
                    <div class="card">
                        <div class="card-header">
                            Listagem de colaboradores
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Permissão</th>
                                        <th scope="col">Jornada</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users" v-bind:key="user.id">
                                        <th>{{ user.name }}</th>
                                        <td>{{ user.email }}</td>
                                        <td>{{ (user.permission === '1') ? 'Gerente': 'Colaborador'  }}</td>
                                        <td>
                                            <select
                                                v-on:change="changeSelect(user.id, $event)"
                                                class="form-control form-control-sm"
                                                v-model="user.working_hour_id"
                                            >
                                                <option
                                                    value="null"
                                                >
                                                    Selecione
                                                </option>
                                                <option
                                                    v-for="workingHour in workingHours"
                                                    v-bind:key="workingHour.id"
                                                    v-bind:value="workingHour.id"
                                                >
                                                    {{workingHour.name}}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <ListViewButton
                                                icon="far fa-eye"
                                                v-on:click.native="viewUser(user.id)"
                                            >
                                            </ListViewButton>
                                            <ListEditButton
                                                icon="far fa-edit"
                                                v-on:click.native="editUser(user.id)"
                                            >
                                            </ListEditButton>
                                            <ListDeleteButton
                                                icon="far fa-trash-alt"
                                                v-on:click.native="deleteUser(user.id)"
                                            ></ListDeleteButton>
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
import SendButton from '@/components/SendButton'
import UserService from '@/services/UserService'
import ListDeleteButton from '@/components/ListDeleteButton'
import ListViewButton from '@/components/ListViewButton'
import NotificationService from '@/services/NotificationService'
import WorkingHourService from '@/services/WorkingHourService'
import ListEditButton from '@/components/ListEditButton'

export default {
    name: 'ListEmployees',
    data () {
        return { users: null, searchText: null, workingHours: null, timeout: null }
    },
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        SendButton,
        ListDeleteButton,
        ListViewButton,
        ListEditButton
    },
    mounted () {
        UserService.getAll('?permission=2')
            .then((users) => {
                if (users) {
                    this.users = users
                }
            })
        WorkingHourService.getAll()
            .then((resp) => {
                this.workingHours = resp
            })
    },
    methods: {
        viewUser (id) {
            this.$router.push({ name: 'manager-view-employee', params: { id: id } })
        },
        editUser (id) {
            this.$router.push({ name: 'manager-edit-employee', params: { id: id } })
        },
        deleteUser (id) {
            UserService.delete(id)
                .then(() => {
                    NotificationService.success('Usuário deletado!')
                    UserService.getAll('?permission=2')
                        .then((users) => {
                            if (users) {
                                this.users = users
                            }
                        })
                })
            UserService.getAll('?permission=2')
                .then((users) => {
                    if (users) {
                        this.users = users
                    }
                })
        },
        async search () {
            clearTimeout(this.timeout)
            this.timeout = setTimeout(async () => {
                this.users = await UserService
                    .getAll('?permission=2&name=' + this.searchText)
            }, 500)
        },
        changeSelect (userId, event) {
            if (event.target.value !== 'null') {
                UserService.updateWorkingHour(userId, event.target.value)
                    .then(() => {
                        NotificationService.success('Jornada de trabalho alterada!')
                        UserService.getAll('?permission=2')
                            .then((users) => {
                                if (users) {
                                    this.users = users
                                }
                            })
                    })
            }
        }
    }
}
</script>

<style scoped>
</style>
