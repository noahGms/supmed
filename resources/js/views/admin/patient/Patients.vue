<template>
  <div class="text-gray-600 body-font">
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-xl font-bold">Manage patients</h1>
      <button
        @click="openPatientFormComponent({address: {}}, true)"
        class="rounded text-indigo-600"
      >
        <i class="fas fa-plus"></i> New patient
      </button>
    </div>
    <div class="w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th
              class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"
            >
              Email
            </th>
            <th
              class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
            >
              Fullname
            </th>
            <th
              class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
            >
              Phone number
            </th>
            <th
              class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
            >
              Role
            </th>
            <th
              class="title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"
            ></th>
          </tr>
        </thead>
        <tbody>
          <template v-if="patients.length">
            <tr v-for="(patient, idx) in patients" :key="idx">
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ patient.email }}
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ patient.fullname }}
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ patient.phone }}
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ patient.role }}
              </td>
              <td class="border-t-2 border-gray-200 text-center">
                <router-link
                  class="text-indigo-600 p-2"
                  :to="{ name: 'admin_patient', params: { id: patient.id } }"
                >
                  <i class="fas fa-eye"></i>
                </router-link>
                <button
                  @click="openPatientFormComponent(patient, false)"
                  class="text-indigo-600 p-2"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button @click="deletePatient(patient)" class="text-red-600 p-2">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
          </template>
          <template v-else>
            <tr>
              <td
                colspan="5"
                class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 w-full"
              >
                <p class="font-bold">No patients found</p>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
      <PatientFormComponent
        v-if="showPatientFormComponent"
        :close="closePatientFormComponent"
        :patientEntity="patient"
        :create="create"
        :patientListing="() => this.$store.dispatch('getAllPatients')"
      />
    </div>
  </div>
</template>

<script>
import PatientFormComponent from '../../../components/admin/PatientFormComponent'

export default {
  name: 'Patients',
  data () {
    return {
      loading: true,
      showPatientFormComponent: false,
      create: true,
      patient: {}
    }
  },
  methods: {
    deletePatient (patient) {
      if (confirm('Are you sur ?')) {
        this.$store.dispatch('deleteOnePatient', patient).finally(() => {
          this.loading = false
          this.$store.dispatch('getAllPatients').finally(() => {
            this.loading = true
          })
        })
      }
    },
    openPatientFormComponent (patient = { address: {} }, create = true) {
      this.showPatientFormComponent = true
      this.patient = patient
      this.create = create
    },
    closePatientFormComponent () {
      this.showPatientFormComponent = false
      this.patient = {}
    }
  },
  computed: {
    patients () {
      return this.$store.getters.get_patients
    }
  },
  created () {
    this.loading = false
    this.$store.dispatch('getAllPatients').finally(() => {
      this.loading = true
    })
  },
  components: {
    PatientFormComponent
  }
}
</script>

<style></style>
