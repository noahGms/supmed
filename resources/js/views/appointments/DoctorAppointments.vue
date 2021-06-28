<template>
    <div v-if="loading" class="container w-full flex flex-col flex-wrap mx-auto px-8">
        <div>
            <p class="text-base font-bold py-2 lg:pb-6 text-gray-700">Appointments</p>
        </div>
        <div class="w-full mx-auto overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
                <thead>
                <tr>
                    <th
                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"
                    >
                        Date
                    </th>
                    <th
                        class="text-center px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                    >
                        Patient
                    </th>
                    <th
                        class="title-font text-center tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"
                    >
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <template v-if="appointments.length">
                    <tr v-for="(appointment, idx) in appointments" :key="idx">
                        <td class="border-t-2 border-gray-200 px-4 py-3">
                            {{ appointment.start_date }}
                        </td>
                        <td class="text-center border-t-2 border-gray-200 px-4 py-3">
                            {{appointment.patient.fullname}}
                        </td>
                        <td class="border-t-2 border-gray-200 text-center">
                            <button
                                :disabled="disableCancelButton(appointment)"
                                @click="cancelAppointment(appointment)"
                                class="rounded bg-red-500 text-white p-2 disabled:opacity-50 disabled:opacity-50"
                            >
                                Cancel
                            </button>
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr>
                        <td
                            colspan="5"
                            class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 w-full"
                        >
                            <p class="font-bold">No appointments found</p>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import moment from "moment"
export default {
    data() {
        return {
            appointments: null,
            loading: false
        }
    },
    methods: {
        cancelAppointment(appointment) {
            if (confirm('Are you sur ?')) {
                this.$store.dispatch('cancelAppointment', appointment).then(response => {
                    this.getMyAppointments()
                })
            }
        },
        getMyAppointments() {
            this.loading = false
            this.$store.dispatch('docAppointments').then(response => {
                this.appointments = response.data.data
                this.loading = true
            })
        },
        disableCancelButton(appointment) {
            const currentDate = moment().format('YYYY-MM-DD')
            const startDate = moment(appointment.start_date).format('YYYY-MM-DD')
            if (currentDate <= startDate) {
                return false
            } else {
                return true
            }
            console.log(currentDate)
            return false
        }
    },
    mounted() {
        this.getMyAppointments()
    }
}
</script>

<style>

</style>
