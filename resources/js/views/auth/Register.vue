<template>
  <div class="bg-white h-screen">
    <div class="w-full flex flex-wrap">
      <div class="w-1/2 shadow-2xl">
        <img
          class="object-cover w-full h-screen hidden md:block"
          src="https://images.unsplash.com/photo-1530497610245-94d3c16cda28?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80"
          alt="Background"
        />
      </div>
      <div class="w-full h-screen md:w-1/2 flex flex-col">
        <div
          class="flex justify-center md:justify-end pt-12 md:pr-12 md:-mb-12"
        >
          <router-link
            :to="{ name: 'home' }"
            class="bg-indigo-600 text-white font-bold text-xl p-3"
            >Supmed</router-link
          >
        </div>

        <div
          class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32"
        >
          <p class="text-center text-3xl">Join Us.</p>
          <form class="flex flex-col pt-3 md:pt-8" @submit.prevent="register">
            <div class="flex flex-col pt-4">
              <label for="email" class="text-lg"
                >Email <span class="text-red-600">*</span></label
              >
              <input
                required
                v-model="user.email"
                type="email"
                id="email"
                placeholder="your@email.com"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
              />
            </div>

            <div class="flex flex-col pt-4">
              <label for="password" class="text-lg"
                >Password <span class="text-red-600">*</span></label
              >
              <input
                required
                v-model="user.password"
                type="password"
                id="password"
                placeholder="Password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
              />
            </div>

            <div class="flex flex-col pt-4">
              <label for="confirm-password" class="text-lg"
                >Confirm password <span class="text-red-600">*</span></label
              >
              <input
                required
                v-model="user.password_confirmation"
                type="password"
                id="confirm-password"
                placeholder="Password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
              />
            </div>

            <div class="flex flex-col pt-4">
              <label for="firstname" class="text-lg">Firstname</label>
              <input
                v-model="user.firstname"
                type="text"
                id="firstname"
                placeholder="John"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
              />
            </div>

            <div class="flex flex-col pt-4">
              <label for="lastname" class="text-lg">Lastname</label>
              <input
                v-model="user.lastname"
                type="text"
                id="lastname"
                placeholder="Smith"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
              />
            </div>

            <div class="flex flex-col pt-4">
              <label for="phone" class="text-lg">Phone number</label>
              <input
                v-model="user.phone"
                type="text"
                id="phone"
                placeholder="0634564589"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
              />
            </div>

            <input
              :disabled="formValid"
              type="submit"
              value="Register"
              class="bg-indigo-600 disabled:opacity-50 text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8"
            />
          </form>
          <div class="text-center pt-12 pb-12">
            <p>
              Already have an account?
              <router-link
                :to="{ name: 'login' }"
                class="text-indigo-600 underline font-semibold"
                >Log in here.</router-link
              >
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Register',
  data () {
    return {
      user: {
        email: '',
        password: '',
        password_confirmation: '',
        firstname: '',
        lastname: '',
        phonenumber: ''
      }
    }
  },
  computed: {
    formValid () {
      return !(
        !!this.user.email &&
        !!this.user.password &&
        !!this.user.password_confirmation
      )
    }
  },
  methods: {
    register () {
      this.$store.dispatch('register', this.user).then(response => {
        this.$router.push({ name: 'login' })
      })
    }
  }
}
</script>

<style></style>
