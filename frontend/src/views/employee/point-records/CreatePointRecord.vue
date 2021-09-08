<template>
    <div class="create-point-record full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Bater Ponto</h1>

            <div class="m-3 card-data">
                <BackButton
                    class="mb-3"
                    content="Voltar"
                    v-on:click.native="$router.go(-1)"
                    icon="fas fa-arrow-left"
                >
                </BackButton>
                <div class="card">
                    <div class="card-header">
                        Bata seu ponto
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>{{now}}</h1>
                            </div>
                            <div class="col-md-6">
                                <div id="map">
                                </div>
                            </div>
                        </div>
                        <button-component
                            ref="button"
                            content="Bater Ponto"
                            v-on:click.native="createPointRecord"
                        >
                        </button-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SendButton from '@/components/SendButton'
import BackButton from '@/components/BackButton'
import EmployeeSidebar from '@/components/employee/EmployeeSidebar'
import EmployeeTopbar from '@/components/employee/EmployeeTopbar'
import PointRecordService from '@/services/PointRecordService'
import NotificationService from '@/services/NotificationService'

export default {
    name: 'CreatePointRecord',
    components: {
        sidebar: EmployeeSidebar,
        topbar: EmployeeTopbar,
        'button-component': SendButton,
        BackButton
    },
    data () {
        return {
            pointRecord: {
                address: null,
                lat: null,
                lng: null
            },
            icon: 'fas fa-check',
            now: null,
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
    mounted () {
        this.now = this.getFormatedDate(Date.now())

        setInterval(() => {
            this.now = this.getFormatedDate(Date.now())
        }, 1000)

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    }
                    this.pointRecord.lat = pos.lat
                    this.pointRecord.lng = pos.lng
                    this.mountMapScript()
                    this.setMapScriptCallback()
                }
            )
        }
    },
    destroyed () {
        const allScripts = Array.from(document.getElementsByTagName('script'))
        const filteredScripts = allScripts.filter((script) => script.src.indexOf('https://maps.googleapis.com/') >= 0)
        filteredScripts.forEach(script => {
            script.remove()
        })
    },
    methods: {
        createPointRecord () {
            PointRecordService.create(this.pointRecord)
                .then(() => {
                    NotificationService.success('Ponto Batido com sucesso!')
                    this.$router.push({ name: 'employee-list-point-records' })
                })
        },
        getFormatedDate (date) {
            const data = new Date(date)
            const day = data.getDate()
            const month = data.getMonth()
            const year = data.getFullYear()
            const hour = data.getHours()
            const minute = data.getMinutes()
            const seconds = data.getSeconds()

            return `${day}/${month}/${year} - ${hour}:${minute}:${seconds}`
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
                        zoom: 8,
                        panControl: false,
                        draggable: false,
                        zoomControl: false,
                        scrollwheel: false,
                        streetViewControl: false
                    })
                    // eslint-disable-next-line no-undef
                    this.mapInfos.marker = new google.maps.Marker({ map: this.mapInfos.map })
                    if (this.pointRecord.lat !== 'null' && this.pointRecord.lng !== 'null') {
                        // eslint-disable-next-line no-undef
                        const latlng = new google.maps.LatLng(this.pointRecord.lat, this.pointRecord.lng)
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
                    // const input = document.getElementById('searchAddressField')
                    // // eslint-disable-next-line
                    // this.mapInfos.autocomplete = new google.maps.places.Autocomplete(input)
                    // this.mapInfos.autocomplete.addListener('place_changed', this.onPlaceChanged)
                    // this.mapInfos.autocomplete.bindTo('bounds', this.mapInfos.map)
                    resolve()
                }
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
