import axios from 'axios'

export const AppointmentModule = {
  state: {
		appointments: []
  },
  getters: {
		get_appointments: (state) => state.appointments
  },
  mutations: {
		set_appointments(state, appointments) {
			state.appointments = appointments
		}
  },
  actions: {
		newAppointment(_, appointment) {
			return new Promise((resolve, reject) => {
				axios.post('/appointments', appointment)
				.then(response => {
					resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
		},
		myAppointments(_) {
			return new Promise((resolve, reject) => {
				axios.get('/myappointments')
				.then(response => {
					resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
		},
        docAppointments(_) {
		    return new Promise((resolve, reject) => {
              axios.get('/docappointments')
                  .then(response => {
                      resolve(response)
                  })
                  .catch(error => {
                      reject(error)
                  })
          })
        },
		cancelAppointment(_, appointment) {
			return new Promise((resolve, reject) => {
				axios.delete('/appointments/' + appointment.id)
				.then(response => {
					resolve(response)
				})
				.catch(error => {
					reject(error)
				})
			})
		}
  }
}
