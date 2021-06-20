<template>
  <div class="text-gray-600 body-font">
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-xl font-bold">Manage admins</h1>
      <button
        @click="openAdminFormComponent({address: {}}, true)"
        class="rounded text-indigo-600"
      >
        <i class="fas fa-plus"></i> New admin
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
          <template v-if="admins.length">
            <tr v-for="(admin, idx) in admins" :key="idx">
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ admin.email }}
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ admin.fullname }}
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ admin.phone }}
              </td>
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ admin.role }}
              </td>
              <td class="border-t-2 border-gray-200 text-center">
                <router-link
                  class="text-indigo-600 p-2"
                  :to="{ name: 'admin_admin', params: { id: admin.id } }"
                >
                  <i class="fas fa-eye"></i>
                </router-link>
                <button
                  @click="openAdminFormComponent(admin, false)"
                  class="text-indigo-600 p-2"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button @click="deleteAdmin(admin)" class="text-red-600 p-2">
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
                <p class="font-bold">No admins found</p>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
      <AdminFormComponent
        v-if="showAdminFormComponent"
        :close="closeAdminFormComponent"
        :adminEntity="admin"
        :create="create"
        :adminListing="() => this.$store.dispatch('getAllAdmins')"
      />
    </div>
  </div>
</template>

<script>
import AdminFormComponent from '../../../components/admin/AdminFormComponent'

export default {
  name: 'Admins',
  data () {
    return {
      loading: true,
      showAdminFormComponent: false,
      create: true,
      admin: {}
    }
  },
  methods: {
    deleteAdmin (admin) {
      if (confirm('Are you sur ?')) {
        this.$store.dispatch('deleteOneAdmin', admin).finally(() => {
          this.loading = false
          this.$store.dispatch('getAllAdmins').finally(() => {
            this.loading = true
          })
        })
      }
    },
    openAdminFormComponent (admin = { address: {} }, create = true) {
      this.showAdminFormComponent = true
      this.admin = admin
      this.create = create
    },
    closeAdminFormComponent () {
      this.showAdminFormComponent = false
      this.admin = {}
    }
  },
  computed: {
    admins () {
      return this.$store.getters.get_admins
    }
  },
  created () {
    this.loading = false
    this.$store.dispatch('getAllAdmins').finally(() => {
      this.loading = true
    })
  },
  components: {
    AdminFormComponent
  }
}
</script>

<style></style>
