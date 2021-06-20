import axios from 'axios'

export const SpecialityModule = {
  state: {
    specialities: []
  },
  getters: {
    get_specialities: (state) => state.specialities
  },
  mutations: {
    set_specialities (state, specialities) {
      state.specialities = specialities
    }
  },
  actions: {
    getAllSpecialities (context) {
      return new Promise((resolve, reject) => {
        axios.get('/specialities')
          .then(response => {
            context.commit('set_specialities', response.data.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getOneSpeciality (_, id) {
      return new Promise((resolve, reject) => {
        axios.get(`/specialities/${id}`)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    newSpeciality (_, speciality) {
      return new Promise((resolve, reject) => {
        axios.post('/specialities', speciality)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateOneSpeciality (_, speciality) {
      return new Promise((resolve, reject) => {
        axios.put(`/specialities/${speciality.id}`, speciality)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    deleteOneSpeciality (_, speciality) {
      return new Promise((resolve, reject) => {
        axios.delete(`/specialities/${speciality.id}`)
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
