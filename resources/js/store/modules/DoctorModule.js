import axios from 'axios'

export const DoctorModule = {
  state: {
    doctors: []
  },
  getters: {
    get_doctors: state => state.doctors
  },
  mutations: {
    set_doctors (state, doctors) {
      state.doctors = doctors
    }
  },
  actions: {
    getAllDoctors (context, search = "") {
      return new Promise((resolve, reject) => {
        axios.get('/doctors?search=' + search)
          .then(response => {
            context.commit('set_doctors', response.data.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getOneDoctor (_, id) {
      return new Promise((resolve, reject) => {
        axios.get(`/doctors/${id}`)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    deleteOneDoctor (_, doctor) {
      return new Promise((resolve, reject) => {
        axios.delete(`/doctors/${doctor.id}`)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    newDoctor (_, doctor) {
      return new Promise((resolve, reject) => {
        axios.post('/doctors', doctor)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateOneDoctor (_, doctor) {
      return new Promise((resolve, reject) => {
        axios.put(`/doctors/${doctor.id}`, doctor)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getAvailabilities (_, { docId, wsId }) {
      return new Promise((resolve, reject) => {
        axios.get(`/doctors/${docId}/workstimes/${wsId}/availabilities`)
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
