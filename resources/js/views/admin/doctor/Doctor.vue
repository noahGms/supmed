<template>
  <div v-if="loading" class="text-gray-600 body-font">
    <div v-if="doctor" class="mb-6 flex justify-between items-center">
      <div>
        <h1 class="text-xl font-bold"><button @click="$router.go(-1)"><i class="fas fa-arrow-left mr-3"></i></button>{{ doctor.fullname }}</h1>
      </div>
      <div>
        <button @click="openDoctorFormComponent" class="rounded mr-6 text-indigo-600">
          <i class="fas fa-edit"></i> Edit
        </button>
        <button @click="deleteDoctor" class="rounded text-red-600">
          <i class="fas fa-trash"></i> Delete
        </button>
      </div>
    </div>
    <div v-else>
      <div
        class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 w-full flex justify-between items-center"
      >
        <p class="font-bold">No doctor found</p>
        <button @click="$router.go(-1)" class="rounded border-2 p-2 text-indigo-600 border-indigo-600 hover:text-white hover:bg-indigo-600">Go back</button>
      </div>
    </div>

    <DoctorFormComponent
        v-if="showDoctorFormComponent"
        :close="closeDoctorFormComponent"
        :doctorEntity="doctor"
        :create="false"
        :doctorListing="getDoctor"
        :specialities="specialities"
      />
  </div>
</template>

<script>
import DoctorFormComponent from '../../../components/admin/DoctorFormComponent'
import { mapGetters } from 'vuex'

export default {
  name: 'Doctor',
  data () {
    return {
      loading: false,
      doctor: null,
      showDoctorFormComponent: false
    }
  },
  methods: {
    deleteDoctor () {
      if (confirm('Are you sur ?')) {
        this.$store.dispatch('deleteOneDoctor', this.doctor).finally(() => {
          this.$store.dispatch('getAllDoctors').finally(() => {
            this.$router.go(-1)
          })
        })
      }
    },
    openDoctorFormComponent () {
      this.showDoctorFormComponent = true
    },
    closeDoctorFormComponent () {
      this.showDoctorFormComponent = false
    },
    getDoctor () {
      this.loading = false
      this.$store
        .dispatch('getOneDoctor', this.$route.params.id)
        .then(response => {
          this.loading = true
          this.doctor = response.data.data
        })
    }
  },
  computed: {
    ...mapGetters({ specialities: 'get_specialities' })
  },
  created () {
    this.getDoctor()
    this.$store.dispatch('getAllSpecialities')
  },
  components: {
    DoctorFormComponent
  }
}
</script>

<style></style>
