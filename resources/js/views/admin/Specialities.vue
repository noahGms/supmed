<template>
  <div v-if="loading" class="text-gray-600 body-font">
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-xl font-bold">Manage specialities</h1>
      <button
        @click="openSpecialityFormComponent()"
        class="rounded text-indigo-600"
      >
        <i class="fas fa-plus"></i> New speciality
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
              class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
            >
              Keywords
            </th>
            <th
              class="title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"
            ></th>
          </tr>
        </thead>
        <tbody>
          <template v-if="specialities.length">
            <tr v-for="(speciality, idx) in specialities" :key="idx">
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ speciality.name }}
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                <span v-for="(keyword, idx) in speciality.keywords" :key="idx" class="inline-flex items-center justify-center px-2 py-2 mr-2 text-xs leading-none text-gray-900 bg-gray-200 rounded-full">{{keyword.name}}</span>
              </td>
              <td class="border-t-2 border-gray-200 text-center">
                <button
                  @click="openSpecialityFormComponent(speciality, false)"
                  class="text-indigo-600 p-2"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button @click="deleteSpeciality(speciality)" class="text-red-600 p-2">
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
                <p class="font-bold">No specialities found</p>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
    <SpecialityFormComponent
      v-if="showSpecialityFormComponent"
      :close="closeSpecialityFormComponent"
      :specialityEntity="speciality"
      :create="create"
      :specialityListing="() => this.$store.dispatch('getAllSpecialities')"
    />
  </div>
</template>

<script>
import SpecialityFormComponent from "../../components/admin/SpecialityFormComponent";

export default {
  name: 'Specialities',
  data () {
    return {
      loading: false,
      showSpecialityFormComponent: false,
      create: true,
      speciality: {}
    }
  },
  methods: {
    deleteSpeciality (speciality) {
      if (confirm('Are you sur ?')) {
        this.$store.dispatch('deleteOneSpeciality', speciality).finally(() => {
          this.loading = false
          this.$store.dispatch('getAllSpecialities').finally(() => {
            this.loading = true
          })
        })
      }
    },
    openSpecialityFormComponent (speciality = { keywords: [] }, create = true) {
      this.showSpecialityFormComponent = true
      this.speciality = speciality
      this.create = create
    },
    closeSpecialityFormComponent () {
      this.showSpecialityFormComponent = false
      this.speciality = {}
    }
  },
  computed: {
    specialities () {
      return this.$store.getters.get_specialities
    }
  },
  created () {
    this.loading = false
    this.$store.dispatch('getAllSpecialities').finally(() => {
      this.loading = true
    })
  },
  components: {
    SpecialityFormComponent
  }
}
</script>

<style>

</style>
