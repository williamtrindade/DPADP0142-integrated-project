<template>
    <canvas id="new-employees-chart" width="400" height="200"></canvas>
</template>

<script>
import ReportsService from '@/services/ReportsService'

export default {
    name: 'NewEmployeesChart',
    data () {
        return {
            newEmployees: null,
            newEmployeesTotal: null
        }
    },
    async mounted () {
        await this.getNewEmployees()
        const ctx = document.querySelector('#new-employees-chart').getContext('2d')
        // eslint-disable-next-line
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: '# of New Employees',
                    data: Object.values(this.newEmployees),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        })
    },
    methods: {
        async getNewEmployees () {
            const resp = await ReportsService.getAll()
            this.newEmployees = resp.new_employees
        }
    }
}
</script>

<style scoped>
</style>
