<template>
  <div v-if="loading">
    <HeaderComponent v-if="$store.getters.logged_in" />
    <router-view />
  </div>
</template>

<script>
import HeaderComponent from './components/layout/HeaderComponent'

export default {
  name: 'App',
  data () {
    return {
      loading: true
    }
  },
  created () {
    if (this.$store.getters.logged_in) {
      this.loading = false
      this.$store.dispatch('whoami').then(response => {
        this.loading = true
      })
    }
  },
  components: {
    HeaderComponent
  }
}
</script>
