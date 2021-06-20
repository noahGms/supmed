import axios from 'axios'

export const WorkstimeModule = {
  state: {
    workstimes: []
  },
  getters: {
    get_workstimes: (state) => state.workstimes
  },
  mutations: {
    set_workstimes (state, workstimes) {
      state.workstimes = workstimes
    }
  },
  actions: {
    getAllWorkstimes (context, id) {
      return new Promise((resolve, reject) => {
        axios.get(`/doctors/${id}/workstimes`)
          .then(response => {
            context.commit('set_workstimes', response.data.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getOneWorkstime (_, docId, wsId) {
      return new Promise((resolve, reject) => {
        axios.get(`/doctors/${docId}/workstimes/${wsId}`)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    newWorkstime (_, { docId, workstime }) {
      return new Promise((resolve, reject) => {
        axios.post(`/doctors/${docId}/workstimes`, workstime)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateOneWorkstime (_, { docId, workstime }) {
      return new Promise((resolve, reject) => {
        axios.put(`/doctors/${docId}/workstimes/${workstime.id}`, workstime)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    deleteOneWorkstime (_, { docId, workstime }) {
      return new Promise((resolve, reject) => {
        axios.delete(`/doctors/${docId}/workstimes/${workstime.id}`)
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
