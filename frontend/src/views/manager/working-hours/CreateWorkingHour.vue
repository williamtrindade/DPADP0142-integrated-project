<template>
    <div class="create-employees full-height">
        <sidebar></sidebar>
        <topbar></topbar>
        <div class="content">
            <h1 class="title-black">Adicionar jornada de trabalho</h1>

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
                                                <label class="form-check-label">{{weekDayObject.day}}</label>
                                            </div>
                                            <!--Week Days--------------------------------------------------------------------------->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <SendButton
                        style="position: fixed; bottom: 10px; right: 15px;"
                        class="mt-3"
                        icon="fas fa-plus"
                        content=""
                        v-on:click.prevent.native="addTimeBlock"
                    >
                    </SendButton>
                    <!--time row---------------------------------------->
                    <SendButton
                        style="position: fixed; bottom: 10px; left: 85px;"
                        class="mt-3"
                        content="Finalizar"
                        icon="fas fa-check"
                    >
                    </SendButton>
                    <BackButton
                        style="position: fixed; bottom: 10px; left: 200px;"
                        class="mt-3"
                        buttonClass="secondary"
                        content="Cancelar"
                        v-on:click.prevent.native="$router.go(-1)"
                    >
                    </BackButton>
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
import BackButton from '@/components/BackButton'
export default {
    name: 'CreateWorkingHour',
    data () {
        return {
            working_hour: {
                name: null,
                description: null
            },
            time_blocks: [
                {
                    start_hour: null,
                    end_hour: null,
                    week_days: [
                        { id: 0, value: false, day: 'SEG' },
                        { id: 1, value: false, day: 'TER' },
                        { id: 2, value: false, day: 'QUA' },
                        { id: 3, value: false, day: 'QUI' },
                        { id: 4, value: false, day: 'SEX' },
                        { id: 5, value: false, day: 'SAB' },
                        { id: 6, value: false, day: 'DOM' }
                    ]
                }
            ]
        }
    },
    components: {
        sidebar: ManagerSidebar,
        topbar: ManagerTopbar,
        SendButton,
        BackButton
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
                    { id: 0, value: false, day: 'SEG' },
                    { id: 1, value: false, day: 'TER' },
                    { id: 2, value: false, day: 'QUA' },
                    { id: 3, value: false, day: 'QUI' },
                    { id: 4, value: false, day: 'SEX' },
                    { id: 5, value: false, day: 'SAB' },
                    { id: 6, value: false, day: 'DOM' }
                ]
            })
        },
        sendForm () {
            WorkingHourService.create(this.$data)
                .then(() => {
                    NotificationService.success('Carga horária criada com sucesso!')
                    this.$router.push({ name: 'manager-working-hours' })
                })
        }
    }
}
</script>

<style scoped>
</style>
