import axios from 'axios'

export const AuthModule = {
  state: {
    token_bearer: localStorage.getItem('token_bearer') || null,
    user: null
  },
  getters: {
    get_token: (state) => state.token_bearer,
    get_user: (state) => state.user,
    logged_in: (state) => !!state.token_bearer,
    is_admin: (state) => state.user?.role === 'admin',
    is_doctor: (state) => state.user?.role === 'doctor'
  },
  mutations: {
    set_token (state, token) {
      state.token_bearer = token
    },
    set_user (state, user) {
      state.user = user
    },
    destroy_token (state) {
      state.token_bearer = null
    }
  },
  actions: {
    login (context, credentials) {
      return new Promise((resolve, reject) => {
        axios.post('/auth/login', credentials)
          .then(response => {
            context.commit('set_token', response.data.token_bearer)
            context.commit('set_user', response.data.data)
            localStorage.setItem('token_bearer', response.data.token_bearer)
            axios.defaults.headers.common.Authorization = `Bearer ${context.getters.get_token}`
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    logout (context) {
      return new Promise((resolve, reject) => {
        axios.post('/auth/logout')
          .then(response => {
            context.commit('destroy_token')
            localStorage.removeItem('token_bearer')
            resolve(response)
          })
          .catch(error => {
            context.commit('destroy_token')
            localStorage.removeItem('token_bearer')
            reject(error)
          })
      })
    },
    register (_, user) {
      return new Promise((resolve, reject) => {
        axios.post('/auth/register', user)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    whoami (context) {
      return new Promise((resolve, reject) => {
        axios.get('/auth/whoami')
          .then(response => {
            context.commit('set_user', response.data.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateMyProfile (context, user) {
      return new Promise((resolve, reject) => {
        axios.post('/auth/whoami', user)
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
