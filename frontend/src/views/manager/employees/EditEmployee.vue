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
                <div class="row">
                    <div class="col-md-6">
                        <form @submit.prevent="saveUser">
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cpf">CPF</label>
                                                <the-mask
                                                    :mask="['###.###.###-##']"
                                                    :masked="false"
                                                    required
                                                    class="form-control"
                                                    placeholder="999.999.999-99"
                                                    v-model="user.cpf"
                                                    id="cpf"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Telefone</label>
                                                <the-mask
                                                    :mask="['+ ## (##) ####-####', '+ ## (##) #####-####']"
                                                    :masked="false"
                                                    required
                                                    class="form-control"
                                                    placeholder="+99 (99) 99999-9999"
                                                    v-model="user.phone"
                                                    id="phone"
                                                />
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
                    <div class="col-md-6">
                        <form @submit.prevent="sendAddress">
                            <div class="card">
                                <div class="card-header">
                                    Endereço do colaborador
                                </div>
                                <div class="card-body">
                                    <div class="row mb-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="searchAddressField">Endereço</label>
                                                <input
                                                    required
                                                    placeholder="Digite um endereço"
                                                    minlength="3"
                                                    maxlength="255"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="user.address"
                                                    id="searchAddressField"
                                                >
                                            </div>
                                            <div id="map">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        </div>
                                    </div>
                                    <button-component
                                        class="mt-3"
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
        </div>
    </div>
</template>

<script>

import ManagerSidebar from '@/components/manager/ManagerSidebar'
import ManagerTopbar from '@/components/manager/ManagerTopbar'
import Button from '@/components/Button'
import UserService from '@/services/UserService'
import NotificationService from '@/services/NotificationService'
// import EmployeeInvitationService from '@/services/EmployeeInvitationService'

export default {
    name: 'EditEmployee',
    mounted () {
        this.getUserData()
            .then(async () => {
                this.mountMapScript()
                this.setMapScriptCallback()
            })
    },
    destroyed () {
        const allScripts = Array.from(document.getElementsByTagName('script'))
        const filteredScripts = allScripts.filter((script) => script.src.indexOf('https://maps.googleapis.com/') >= 0)
        filteredScripts.forEach(script => {
            script.remove()
        })
    },
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        'button-component': Button
    },
    data () {
        return {
            user: {
                id: null,
                name: null,
                email: null,
                lat: null,
                lng: null,
                address: null,
                phone: null,
                cpf: null
            },
            address: {
                text: null,
                lat: null,
                lng: null
            },
            key: 'AIzaSyA9r-z8yUPJMrxuUnoPwhU3Os4T6JL9Wd8',
            mapInfos: {
                autocomplete: null,
                map: null,
                marker: null,
                geocoder: null,
                circle: null
            }
        }
    },
    methods: {
        async getUserData () {
            if (this.$route.params.id) {
                try {
                    const user = await UserService.getUser(this.$route.params.id)
                    this.user = user
                } catch (e) {
                    this.$router.push({ name: 'not-found' })
                }
            } else {
                this.$router.push({ name: 'not-found' })
            }
        },
        mountMapScript () {
            const script = document.createElement('script')
            script.src = 'https://maps.googleapis.com/maps/api/js?key=' + this.key + '&libraries=places&callback=initMap'
            script.defer = true
            document.head.appendChild(script)
        },
        setMapScriptCallback () {
            return new Promise((resolve, reject) => {
                window.initMap = () => {
                    // eslint-disable-next-line no-undef
                    this.mapInfos.map = new google.maps.Map(document.getElementById('map'), {
                        center: { lat: -34.397, lng: 150.644 },
                        zoom: 8
                    })
                    // eslint-disable-next-line no-undef
                    this.mapInfos.marker = new google.maps.Marker({ map: this.mapInfos.map })
                    if (this.user.lat !== 'null' && this.user.lng !== 'null') {
                        // eslint-disable-next-line no-undef
                        const latlng = new google.maps.LatLng(this.user.lat, this.user.lng)
                        this.mapInfos.marker.setPosition(latlng)
                        // eslint-disable-next-line no-undef
                        this.mapInfos.map.setCenter(latlng)
                        this.mapInfos.map.setZoom(18)

                        // eslint-disable-next-line no-undef
                        this.mapInfos.circle = new google.maps.Circle({
                            radius: 50,
                            fillColor: '#00ff9d',
                            strokeColor: '#00ff9d',
                            strokeOpacity: 0.75,
                            strokeWeight: 1
                        })
                        this.mapInfos.circle.bindTo('center', this.mapInfos.marker, 'position')
                        this.mapInfos.circle.bindTo('map', this.mapInfos.marker, 'map')
                    }
                    const input = document.getElementById('searchAddressField')
                    // eslint-disable-next-line
                    this.mapInfos.autocomplete = new google.maps.places.Autocomplete(input)
                    this.mapInfos.autocomplete.addListener('place_changed', this.onPlaceChanged)
                    this.mapInfos.autocomplete.bindTo('bounds', this.mapInfos.map)
                    resolve()
                }
            })
        },
        onPlaceChanged () {
            const place = this.mapInfos.autocomplete.getPlace()
            if (place.geometry) {
                this.mapInfos.map.panTo(place.geometry.location)
                this.mapInfos.map.setZoom(18)
                this.user.address = place.formatted_address
                this.address.lat = place.geometry.location.lat()
                this.address.lng = place.geometry.location.lng()
                this.user.lat = place.geometry.location.lat()
                this.user.lng = place.geometry.location.lng()
                // eslint-disable-next-line no-undef
                const latlng = new google.maps.LatLng(this.address.lat, this.address.lng)
                // eslint-disable-next-line no-undef
                this.mapInfos.marker.setPosition(latlng)
            }
        },
        saveUser () {
            UserService.updateUser(this.user, this.user.id)
                .then(() => {
                    NotificationService.success('Dados do usuário alterados!')
                })
        },
        sendAddress () {
            UserService.updateAddress(this.user.lat, this.user.lng, this.user.address, this.user.id)
                .then((resp) => {
                    NotificationService.success('Endereço do susuário alterado!')
                })
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
