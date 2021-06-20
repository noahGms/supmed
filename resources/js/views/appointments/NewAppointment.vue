<template>
	<div v-if="loading" class="container w-full flex flex-col flex-wrap mx-auto px-8">
    <div>
      <p class="text-base py-2 lg:pb-6 text-gray-700">New appointment</p>
    </div>
		<form v-if="workstimes.length" class="flex justify-center align-items flex-col">
			<div v-if="!selectedWorkstime" class="flex justify-center align-items flex-wrap -m-4">
				<div class="p-4 lg:w-1/3 cursor-pointer" @click="selectWorkstime(workstime)" v-for="(workstime, idx) in workstimes" :key="idx">
					<div class="h-full bg-gray-100 bg-opacity-75 px-8 pt-16 pb-24 rounded-lg overflow-hidden text-center relative">
						<h1 class="text-gray-900 mb-3">{{formatDate(workstime)}}</h1>
					</div>
				</div>
			</div>
			<div v-if="timeslots" class="flex justify-center align-items flex-wrap -m-4 max-h-200">
				<div class="p-4 lg:w-1/5"  v-for="(timeslot, idx) in timeslots" :key="idx">
					<div :class="['h-full bg-opacity-75 px-8 pt-16 pb-24 rounded-lg overflow-hidden text-center relative', timeslot.free ? 'cursor-pointer bg-indigo-200' : 'bg-red-200']" @click="selectTimeslot(timeslot)">
						<h1 class="text-gray-900 mb-3">{{timeslot.start}} - {{timeslot.end}}</h1>
					</div>
				</div>
			</div>
		</form>
		<template v-else>
				<div
					class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 w-full"
				>
					<p class="font-bold">No workstimes found</p>
				</div>
		</template>
		<AppointmentFormComponent
			v-if="showAppointmentFormComponent"
			:close="closeAppointmentFormComponent"
			:appointmentEntity="appointment"
			:workstime="selectedWorkstime"
			:doctor="doctor"
			:user="user"
			:appointmentsTypes="appointmentsTypes"
		/>
	</div>
</template>

<script>
import moment from "moment"
import AppointmentFormComponent from "../../components/AppointmentFormComponent"
import {mapGetters} from "vuex"

export default {
	data() {
		return {
			doctor: null,
			workstimes: null,
			selectedWorkstime: null,
			timeslots: null,
			loading: false,
			selectedTimeslot: null,
			showAppointmentFormComponent: false,
			appointment: {}
		}
	},
	methods: {
		selectWorkstime(workstime) {
			this.selectedWorkstime = workstime
			this.$store.dispatch('getAvailabilities', {docId: this.doctor.id, wsId: workstime.id}).then(response => {
				this.timeslots = response.data.data
			})
		},
		formatDate(workstime) {
			return moment(workstime.start).format('MMMM Do YYYY')
		},
		selectTimeslot(timeslot) {
			this.selectedTimeslot = timeslot
			this.appointment = {
				start_date: moment(this.selectedWorkstime.start).format('YYYY-MM-DD'),
				start_time: timeslot.start,
				end_date: moment(this.selectedWorkstime.end).format('YYYY-MM-DD'),
				end_time: timeslot.end
			}
			this.showAppointmentFormComponent = true
		},
		closeAppointmentFormComponent() {
			this.showAppointmentFormComponent = false
			this.selectedWorkstime = null
			this.selectedTimeslot = null
			this.timeslots = null
		}
	},
	mounted() {
		this.loading = false
		this.$store.dispatch('getAllAppointmentsTypes')
		this.$store.dispatch('getOneDoctor', this.$route.params.id).then(response => {
			this.doctor = response.data.data
			this.$store.dispatch('getAllWorkstimes', this.doctor.id).then(wsResponse => {
				this.workstimes = wsResponse.data.data
				this.loading = true
			})
		})
	},
	computed: {
		...mapGetters({user: 'get_user', appointmentsTypes: 'get_appointments_types'})
	},
	components: {
		AppointmentFormComponent
	}
}
</script>

<style>

</style>