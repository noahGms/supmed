import axios from 'axios'

export const AppointmentsTypeModule = {
  state: {
    appointmentsTypes: []
  },
  getters: {
    get_appointments_types: (state) => state.appointmentsTypes
  },
  mutations: {
    set_appointments_types (state, appointmentsTypes) {
      state.appointmentsTypes = appointmentsTypes
    }
  },
  actions: {
    getAllAppointmentsTypes (context) {
      return new Promise((resolve, reject) => {
        axios.get('/appointmentsTypes')
          .then(response => {
            context.commit('set_appointments_types', response.data.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    newAppointmentsType (_, appointmentsType) {
      return new Promise((resolve, reject) => {
        axios.post('/appointmentsTypes', appointmentsType)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getOneAppointmentsType (_, appointmentsType) {
      return new Promise((resolve, reject) => {
        axios.get(`/appointmentsTypes/${appointmentsType.id}`)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateOneAppointmentsType (_, appointmentsType) {
      return new Promise((resolve, reject) => {
        axios.put(`/appointmentsTypes/${appointmentsType.id}`, appointmentsType)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    deleteOneAppointmentsType (_, appointmentsType) {
      return new Promise((resolve, reject) => {
        axios.delete(`/appointmentsTypes/${appointmentsType.id}`)
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
