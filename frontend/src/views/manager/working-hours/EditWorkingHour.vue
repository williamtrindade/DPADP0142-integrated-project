<template>
    <div class="create-employees full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Editar jornada de trabalho</h1>

            <div class="m-3 card-data">
                <!--FORM------------------------------------------------->
                <form class="mb-5 pb-5" v-on:submit.prevent="sendForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input
                                    required
                                    placeholder="Digite o nome da joranda"
                                    minlength="3"
                                    maxlength="255"
                                    v-model="working_hour.name"
                                    type="text"
                                    class="form-control"
                                    id="name"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <input
                                    required
                                    placeholder="Digite a descrição da jornada"
                                    minlength="3"
                                    maxlength="255"
                                    v-model="working_hour.description"
                                    type="text"
                                    class="form-control"
                                    id="description"
                                />
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!--time row---------------------------------------->
                    <div
                        class="time-blocks"
                        v-for="(time_block, index) in time_blocks"
                        v-bind:key="index"
                    >
                        <div class="card mb-2 shadow">
                            <div class="card-header">
                                Bloco de horário
                                <a
                                    @click="removeItem(index)"
                                    class="remove-time-block"
                                    style="display:inline; float:right; color:red;border:none;"
                                >
                                    <i class="fas fa-minus-circle"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="entrance">Entrada</label>
                                            <input
                                                required
                                                minlength="3"
                                                maxlength="255"
                                                v-model="time_block.start_hour"
                                                type="time"
                                                class="form-control"
                                                id="entrance"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exit">Saída</label>
                                            <input
                                                required
                                                minlength="3"
                                                maxlength="255"
                                                v-model="time_block.end_hour"
                                                type="time"
                                                class="form-control"
                                                id="exit"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="week-days">Dias da semana</label><br>
                                        <div class="form-group">
                                            <!--week Days-------------------------------------------------------------------------->
                                            <div class="form-check form-check-inline"
                                                 v-for="(weekDayObject, weekDaysIndex) in time_block.week_days"
                                                 v-bind:key="weekDaysIndex"
                                            >
                                                <input
                                                    v-model="weekDayObject.value"
                                                    class="form-check-input"
                                                    type="checkbox"
                                                >
                                                <label class="form-check-label">{{daysVariables[weekDaysIndex]}}</label>
                                            </div>
                                            <!--Week Days--------------------------------------------------------------------------->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button-component
                        style="position: fixed;
                            bottom: 10px;
                            right: 15px;
                            "
                        class="mt-3"
                        buttonClass="button-primary"
                        ref="button-add-time-block"
                        icon="fas fa-plus"
                        content=""
                        v-on:click.prevent.native="addTimeBlock"
                    >
                    </button-component>

                    <!--time row---------------------------------------->
                    <button-component
                        style="position: fixed;
                            bottom: 10px;
                            left: 85px;
                            "
                        class="mt-3"
                        ref="button"
                        content="Salvar"
                        icon="fas fa-check"
                    >
                    </button-component>
                    <button-component
                        style="position: fixed;
                            bottom: 10px;
                            left: 200px;
                            "
                        class="mt-3"
                        buttonClass="button-secondary"
                        ref="button"
                        content="Cancelar"
                        v-on:click.prevent.native="$router.go(-1)"
                    >
                    </button-component>
                </form>
                <!--FORM------------------------------------------------->
            </div>
        </div>
    </div>
</template>

<script>
import ManagerSidebar from '@/components/manager/ManagerSidebar'
import ManagerTopbar from '@/components/manager/ManagerTopbar'
import SendButton from '@/components/SendButton'
import WorkingHourService from '@/services/WorkingHourService'
import NotificationService from '@/services/NotificationService'
import DaysVariables from '@/views/manager/working-hours/DaysVariables'

export default {
    name: 'CreateWorkingHour',
    data () {
        return {
            daysVariables: DaysVariables.weekDays,
            working_hour: {
                name: null,
                description: null
            },
            time_blocks: null
        }
    },
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        'button-component': SendButton
    },
    mounted () {
        if (this.$route.params.id) {
            WorkingHourService.get(this.$route.params.id)
                .then((workingHour) => {
                    this.working_hour = workingHour
                    this.time_blocks = workingHour.time_blocks
                    delete workingHour.time_blocks
                }).catch(() => {
                    this.$router.push({ name: 'not-found' })
                })
        } else {
            this.$router.push({ name: 'not-found' })
        }
    },
    methods: {
        removeItem (index) {
            this.time_blocks.splice(index, 1)
        },
        addTimeBlock () {
            this.time_blocks.push({
                start_hour: null,
                end_hour: null,
                week_days: [
                    { id: 0, value: false },
                    { id: 1, value: false },
                    { id: 2, value: false },
                    { id: 3, value: false },
                    { id: 4, value: false },
                    { id: 5, value: false },
                    { id: 6, value: false }
                ]
            })
        },
        sendForm () {
            WorkingHourService.update(this.$data, this.$route.params.id)
                .then(() => {
                    NotificationService.success('Carga horária alterada com sucesso!')
                    this.$router.push({ name: 'manager-working-hours' })
                })
        }
    }
}
</script>

<style scoped>
.card {
    border-radius: 0;
}
</style>
