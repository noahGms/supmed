<template>
  <div v-if="loading" class="text-gray-600 body-font">
    <div v-if="patient" class="mb-6 flex justify-between items-center">
      <div>
        <h1 class="text-xl font-bold"><button @click="$router.go(-1)"><i class="fas fa-arrow-left mr-3"></i></button>{{ patient.fullname }}</h1>
      </div>
      <div>
        <button @click="openPatientFormComponent" class="rounded mr-6 text-indigo-600">
          <i class="fas fa-edit"></i> Edit
        </button>
        <button @click="deletePatient" class="rounded text-red-600">
          <i class="fas fa-trash"></i> Delete
        </button>
      </div>
    </div>
    <div v-else>
      <div
        class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 w-full flex justify-between items-center"
      >
        <p class="font-bold">No patient found</p>
        <button @click="$router.go(-1)" class="rounded border-2 p-2 text-indigo-600 border-indigo-600 hover:text-white hover:bg-indigo-600">Go back</button>
      </div>
    </div>

    <PatientFormComponent
        v-if="showPatientFormComponent"
        :close="closePatientFormComponent"
        :patientEntity="patient"
        :create="false"
        :patientListing="getPatient"
      />
  </div>
</template>

<script>
import PatientFormComponent from '../../../components/admin/PatientFormComponent'

export default {
  name: 'Patient',
  data () {
    return {
      loading: false,
      patient: null,
      showPatientFormComponent: false
    }
  },
  methods: {
    deletePatient () {
      if (confirm('Are you sur ?')) {
        this.$store.dispatch('deleteOnePatient', this.patient).finally(() => {
          this.$store.dispatch('getAllPatients').finally(() => {
            this.$router.go(-1)
          })
        })
      }
    },
    openPatientFormComponent () {
      this.showPatientFormComponent = true
    },
    closePatientFormComponent () {
      this.showPatientFormComponent = false
    },
    getPatient () {
      this.loading = false
      this.$store
        .dispatch('getOnePatient', this.$route.params.id)
        .then(response => {
          this.loading = true
          this.patient = response.data.data
        })
    }
  },
  created () {
    this.getPatient()
  },
  components: {
    PatientFormComponent
  }
}
</script>

<style></style>
