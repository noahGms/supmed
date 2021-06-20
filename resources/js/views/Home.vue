<template>
  <div class="container w-full flex flex-col flex-wrap mx-auto px-8">
    <div>
      <p class="text-base py-2 lg:pb-6 text-gray-700">
        Welcome <span class="font-bold">{{ user.fullname }}</span>
      </p>
    </div>
    <div>
      <div>
        <form @submit.prevent="handleSearch" class="border rounded overflow-hidden flex justify-between">
          <input
            type="text"
            class="px-4 py-2 w-full"
            v-model="search"
            placeholder="Search by name, address, specialities or disease ..."
          />
          <button type="submit" class="flex items-center justify-center px-4 border-l">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>
    </div>
    <div class="flex flex-wrap -m-2 mt-4">
      <div
        v-for="(doctor, idx) in doctors"
        :key="idx"
        class="p-2 lg:w-1/3 md:w-1/2 w-full"
      >
        <div
          class="h-full flex items-center border-gray-200 border p-4 rounded-lg"
        >
          <img
            alt="team"
            class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4"
            :src="`https://randomuser.me/api/portraits/med/men/${idx}.jpg`"
          />
          <div class="flex-grow">
            <h2 class="text-gray-900 title-font font-medium">
              {{ doctor.fullname }}
            </h2>
            <h4 class="text-xs">{{ doctor.address.fulladdress }}</h4>
            <div class="mt-2">
              <span
                v-for="(speciality, idx) in doctor.specialities"
                :key="idx"
                class="inline-flex items-center justify-center px-2 py-2 mr-2 text-xs leading-none text-gray-900 bg-gray-200 rounded-full"
                >{{ speciality.name }}</span
              >
            </div>
            <div class="flex justify-end py-2">
              <router-link :to="{name: 'new_appointment', params: {id: doctor.id}}" v-if="$store.getters.is_patient" class="text-indigo-500 inline-flex mr-3">Take appointment</router-link>
              <router-link :to="{name: 'new_appointment', params: {id: doctor.id}}"><i class="fas fa-external-link-alt"></i></router-link>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'Home',
  data() {
    return {
      search: '',
      loading: false
    }
  },
  computed: {
    ...mapGetters({ user: 'get_user', doctors: 'get_doctors' }),
  },
  methods: {
    handleSearch() {
      this.getDoctors()
    },
    getDoctors() {
      this.loading = false
      this.$store.dispatch('getAllDoctors', this.search).then(_ => {
        this.loading = true
      })
    }
  },
  created() {
    this.getDoctors()
  }
};
</script>
