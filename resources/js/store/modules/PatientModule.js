import axios from 'axios'

export const PatientModule = {
  state: {
    patients: []
  },
  getters: {
    get_patients: (state) => state.patients
  },
  mutations: {
    set_patients (state, patients) {
      state.patients = patients
    }
  },
  actions: {
    getAllPatients (context) {
      return new Promise((resolve, reject) => {
        axios.get('/patients')
          .then(response => {
            context.commit('set_patients', response.data.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getOnePatient (_, id) {
      return new Promise((resolve, reject) => {
        axios.get(`/patients/${id}`)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    newPatient (_, patient) {
      return new Promise((resolve, reject) => {
        axios.post('/patients', patient)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateOnePatient (_, patient) {
      return new Promise((resolve, reject) => {
        axios.put(`/patients/${patient.id}`, patient)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    deleteOnePatient (_, patient) {
      return new Promise((resolve, reject) => {
        axios.delete(`/patients/${patient.id}`)
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
