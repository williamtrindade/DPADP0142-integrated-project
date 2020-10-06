<template>
    <div class="create-employees full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Alterar dados do colaborador</h1>

            <div class="m-3 card-data">
                <button-component
                    class="mb-3"
                    content="Voltar"
                    v-on:click.native="$router.go(-1)"
                    icon="fas fa-arrow-left"
                >
                </button-component>
                <form @on:submit.prevent="sendForm">

                    <div class="card">
                        <div class="card-header">
                            Dados básicos
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input
                                    required
                                    placeholder="Email do colaborador"
                                    minlength="3"
                                    maxlength="255"
                                    v-model="user.name"
                                    type="text"
                                    class="form-control"
                                    id="name"
                                >
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    required
                                    placeholder="Nome do colaborador"
                                    minlength="3"
                                    maxlength="255"
                                    v-model="user.email"
                                    type="text"
                                    class="form-control"
                                    id="email"
                                >
                            </div>
                            <button-component
                                ref="button"
                                content="Salvar"
                                icon="fas fa-check"
                            >
                            </button-component>
                        </div>
                    </div>
                </form>

                <form>
                    <div class="card mt-3">
                        <div class="card-header">
                            Endereço
                        </div>
                        <div class="card-body">
                            <!-- <div class="form-group">
                                <label for="name">Nome</label>
                                <input
                                    required
                                    placeholder="Digite seu nome"
                                    minlength="3"
                                    maxlength="255"
                                    v-model="name"
                                    type="text"
                                    class="form-control"
                                    id="name"
                                >
                            </div> -->
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="email">Endereço</label>
                                        <input
                                            required
                                            placeholder="Digite um endereço"
                                            minlength="3"
                                            maxlength="255"
                                            v-model="address"
                                            type="text"
                                            class="form-control"
                                            id="address"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div id="map">
                                    </div>
                                </div>
                            </div>
                            <button-component
                                ref="button"
                                content="Salvar"
                                icon="fas fa-check"
                            >
                            </button-component>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import ManagerSidebar from '@/components/manager/ManagerSidebar'
import ManagerTopbar from '@/components/manager/ManagerTopbar'
import Button from '@/components/Button'
// import NotificationService from '@/services/NotificationService'
// import EmployeeInvitationService from '@/services/EmployeeInvitationService'

export default {
    name: 'EditEmployee',
    created () {
        this.mountMapScript()
    },
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        'button-component': Button
    },
    data () {
        return {
            user: {
                name: 'Wil',
                email: 'wil@odig.net'
            },
            address: null,
            key: 'AIzaSyA9r-z8yUPJMrxuUnoPwhU3Os4T6JL9Wd8'
        }
    },
    methods: {
        mountMapScript () {
            // Create the script tag, set the appropriate attributes
            var script = document.createElement('script')
            script.src = 'https://maps.googleapis.com/maps/api/js?key=' + this.key + '&callback=initMap'
            script.defer = true

            // Attach your callback function to the `window` object
            window.initMap = function () {
                // eslint-disable-next-line
                let map
                // eslint-disable-next-line
                map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: -34.397, lng: 150.644 },
                    zoom: 8
                })
            }
            // Append the 'script' element to 'head'
            document.head.appendChild(script)
        },
        sendForm () {
        }
    }
}
</script>

<style scoped>
#map {
    width: 100%;
    height: 400px;
    background-color: grey;
}
</style>
