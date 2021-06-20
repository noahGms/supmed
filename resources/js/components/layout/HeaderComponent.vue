<template>
  <div class="mb-4">
    <nav class="bg-white py-2 md:py-4">
      <div class="container px-4 mx-auto md:flex md:items-center">
        <div class="flex justify-between items-center">
          <router-link
            :to="{ name: 'home' }"
            class="bg-indigo-600 text-white font-bold text-xl p-3"
            >Supmed</router-link
          >
          <button
            class="border border-solid border-gray-600 px-3 py-1 rounded text-gray-600 opacity-50 hover:opacity-75 md:hidden"
            id="navbar-toggle"
          >
            <i class="fas fa-bars"></i>
          </button>
        </div>

        <div
          class="hidden md:flex flex-col md:flex-row md:ml-auto mt-3 md:mt-0"
          id="navbar-collapse"
        >
          <router-link
            :to="{ name: 'home' }"
            active-class="text-indigo-600"
            class="p-2 lg:px-4 md:mx-2 rounded hover:bg-gray-200 transition-colors duration-300 "
            >Home</router-link
          >
          <router-link
            v-if="$store.getters.is_doctor"
            :to="{ name: 'workstimes' }"
            active-class="text-indigo-600"
            class="p-2 lg:px-4 md:mx-2 rounded hover:bg-gray-200 transition-colors duration-300 "
            >Workstimes</router-link
          >
          <router-link
            v-if="$store.getters.is_admin"
            :to="{ name: 'admin' }"
            active-class="text-indigo-600"
            class="p-2 lg:px-4 md:mx-2 rounded hover:bg-gray-200 transition-colors duration-300 "
            >Admin</router-link
          >
          <router-link
            :to="{ name: 'profile' }"
            active-class="text-indigo-600"
            class="p-2 lg:px-4 md:mx-2 rounded hover:bg-gray-200 transition-colors duration-300 "
            >Profile</router-link
          >
          <button
            @click="logout"
            class="p-2 lg:px-4 md:mx-2 text-indigo-600 text-center border border-solid border-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition-colors duration-300 mt-1 md:mt-0 md:ml-1 cursor-pointer"
            >Logout <i class="fas fa-sign-out-alt"></i
          ></button>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'HeaderComponent',
  methods: {
    logout () {
      this.$store.dispatch('logout').finally(response => {
        this.$router.push({ name: 'login' })
      })
    }
  },
  mounted () {
    const toggleBtn = document.querySelector('#navbar-toggle')
    const collapse = document.querySelector('#navbar-collapse')

    toggleBtn.onclick = () => {
      collapse.classList.toggle('hidden')
      collapse.classList.toggle('flex')
    }
  }
}
</script>

<style></style>
