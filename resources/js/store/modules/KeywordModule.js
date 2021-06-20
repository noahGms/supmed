import axios from 'axios'

export const KeywordModule = {
  state: {
    keywords: []
  },
  getters: {
    get_keywords: (state) => state.keywords
  },
  mutations: {
    set_keywords (state, keywords) {
      state.keywords = keywords
    }
  },
  actions: {
    getAllKeywords (context) {
      return new Promise((resolve, reject) => {
        axios.get('/keywords')
          .then(response => {
            context.commit('set_keywords', response.data.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    getOneKeyword (_, id) {
      return new Promise((resolve, reject) => {
        axios.get(`/keywords/${id}`)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    newKeyword (_, keyword) {
      return new Promise((resolve, reject) => {
        axios.post('/keywords', keyword)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    updateOneKeyword (_, keyword) {
      return new Promise((resolve, reject) => {
        axios.put(`/keywords/${keyword.id}`, keyword)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    deleteOneKeyword (_, keyword) {
      return new Promise((resolve, reject) => {
        axios.delete(`/keywords/${keyword.id}`)
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
