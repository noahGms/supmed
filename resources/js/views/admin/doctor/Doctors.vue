<template>
  <div class="text-gray-600 body-font">
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-xl font-bold">Manage doctors</h1>
      <button
        @click="openDoctorFormComponent({specialities: [], address: {}}, true)"
        class="rounded text-indigo-600"
      >
        <i class="fas fa-plus"></i> New doctor
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
              Specialities
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
          <template v-if="doctors.length">
            <tr v-for="(doctor, idx) in doctors" :key="idx">
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ doctor.email }}
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ doctor.fullname }}
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ doctor.phone }}
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                <span v-for="(speciality, idx) in doctor.specialities" :key="idx" class="inline-flex items-center justify-center px-2 py-2 mr-2 text-xs leading-none text-gray-900 bg-gray-200 rounded-full">{{speciality.name}}</span>
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ doctor.role }}
              </td>
              <td class="border-t-2 border-gray-200 text-center">
                <router-link
                  class="text-indigo-600 p-2"
                  :to="{ name: 'admin_doctor', params: { id: doctor.id } }"
                >
                  <i class="fas fa-eye"></i>
                </router-link>
                <button
                  @click="openDoctorFormComponent(doctor, false)"
                  class="text-indigo-600 p-2"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button @click="deleteDoctor(doctor)" class="text-red-600 p-2">
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
                <p class="font-bold">No doctors found</p>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
      <DoctorFormComponent
        v-if="showDoctorFormComponent"
        :close="closeDoctorFormComponent"
        :doctorEntity="doctor"
        :create="create"
        :doctorListing="() => this.$store.dispatch('getAllDoctors')"
        :specialities="specialities"
      />
    </div>
  </div>
</template>

<script>
import DoctorFormComponent from '../../../components/admin/DoctorFormComponent'
import { mapGetters } from 'vuex'

export default {
  name: 'Doctors',
  data () {
    return {
      loading: true,
      showDoctorFormComponent: false,
      doctor: {},
      create: true
    }
  },
  methods: {
    deleteDoctor (doctor) {
      if (confirm('Are you sur ?')) {
        this.$store.dispatch('deleteOneDoctor', doctor).finally(() => {
          this.loading = false
          this.$store.dispatch('getAllDoctors').finally(() => {
            this.loading = true
          })
        })
      }
    },
    openDoctorFormComponent (doctor = { specialities: [], address: {} }, create = true) {
      this.showDoctorFormComponent = true
      this.doctor = doctor
      this.create = create
    },
    closeDoctorFormComponent () {
      this.showDoctorFormComponent = false
      this.doctor = {}
    }
  },
  computed: {
    ...mapGetters({ doctors: 'get_doctors', specialities: 'get_specialities' })
  },
  created () {
    this.loading = false
    this.$store.dispatch('getAllDoctors').finally(() => {
      this.loading = true
    })
    this.$store.dispatch('getAllSpecialities')
  },
  components: {
    DoctorFormComponent
  }
}
</script>

<style></style>
