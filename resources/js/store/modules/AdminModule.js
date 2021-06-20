import axios from 'axios'

export const AdminModule = {
  state: {
    admins: []
  },
  getters: {
    get_admins: (state) => state.admins
  },
  mutations: {
    set_admins (state, admins) {
      state.admins = admins
    }
  },
  actions: {
    getAllAdmins (context) {
      return new Promise((resolve, reject) => {
        axios.get('/admins')
          .then(response => {
            context.commit('set_admins', response.data.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getOneAdmin (_, id) {
      return new Promise((resolve, reject) => {
        axios.get(`/admins/${id}`)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    newAdmin (_, admin) {
      return new Promise((resolve, reject) => {
        axios.post('/admins', admin)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateOneAdmin (_, admin) {
      return new Promise((resolve, reject) => {
        axios.put(`/admins/${admin.id}`, admin)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    deleteOneAdmin (_, admin) {
      return new Promise((resolve, reject) => {
        axios.delete(`/admins/${admin.id}`)
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
