<template>
  <div v-if="loading" class="text-gray-600 body-font">
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-xl font-bold">Manage appointments types</h1>
      <button
        @click="openAppointmentsTypeFormComponent({}, true)"
        class="rounded text-indigo-600"
      >
        <i class="fas fa-plus"></i> New appointment type
      </button>
    </div>
    <div class="w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th
              class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"
            >
              Name
            </th>
            <th
              class="title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"
            ></th>
          </tr>
        </thead>
        <tbody>
          <template v-if="appointmentsTypes.length">
            <tr v-for="(appointmentsType, idx) in appointmentsTypes" :key="idx">
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ appointmentsType.name }}
              </td>
              <td class="border-t-2 border-gray-200 text-center">
                <button
                  @click="openAppointmentsTypeFormComponent(appointmentsType, false)"
                  class="text-indigo-600 p-2"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button @click="deleteAppointmentsType(appointmentsType)" class="text-red-600 p-2">
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
                <p class="font-bold">No appointment types found</p>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
    <AppointmentsTypeFormComponent
      v-if="showAppointmentsTypeFormComponent"
      :close="closeAppointmentsTypeFormComponent"
      :appointmentsTypeEntity="appointmentsType"
      :create="create"
      :appointmentsTypeListing="() => this.$store.dispatch('getAllAppointmentsTypes')"
    />
  </div>
</template>

<script>
import AppointmentsTypeFormComponent from "../../components/admin/AppointmentsTypeFormComponent";

export default {
  name: 'AppointmentsTypes',
  data () {
    return {
      loading: false,
      showAppointmentsTypeFormComponent: false,
      create: true,
      appointmentsType: {}
    }
  },
  methods: {
    deleteAppointmentsType (appointmentsType) {
      if (confirm('Are you sur ?')) {
        this.$store.dispatch('deleteOneAppointmentsType', appointmentsType).finally(() => {
          this.loading = false
          this.$store.dispatch('getAllAppointmentsTypes').finally(() => {
            this.loading = true
          })
        })
      }
    },
    openAppointmentsTypeFormComponent (appointmentsType = {}, create = true) {
      this.showAppointmentsTypeFormComponent = true
      this.appointmentsType = appointmentsType
      this.create = create
    },
    closeAppointmentsTypeFormComponent () {
      this.showAppointmentsTypeFormComponent = false
      this.appointmentsType = {}
    }
  },
  computed: {
    appointmentsTypes () {
      return this.$store.getters.get_appointments_types
    }
  },
  created () {
    this.loading = false
    this.$store.dispatch('getAllAppointmentsTypes').finally(() => {
      this.loading = true
    })
  },
  components: {
    AppointmentsTypeFormComponent
  }
}
</script>

<style>

</style>
