<template>
  <div v-if="loading" class="text-gray-600 body-font">
    <div v-if="admin" class="mb-6 flex justify-between items-center">
      <div>
        <h1 class="text-xl font-bold">
          <button @click="$router.go(-1)">
            <i class="fas fa-arrow-left mr-3"></i></button
          >{{ admin.fullname }}
        </h1>
      </div>
      <div>
        <button
          @click="openAdminFormComponent"
          class="rounded mr-6 text-indigo-600"
        >
          <i class="fas fa-edit"></i> Edit
        </button>
        <button @click="deleteAdmin" class="rounded text-red-600">
          <i class="fas fa-trash"></i> Delete
        </button>
      </div>
    </div>
    <div v-else>
      <div
        class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 w-full flex justify-between items-center"
      >
        <p class="font-bold">No admin found</p>
        <button
          @click="$router.go(-1)"
          class="rounded border-2 p-2 text-indigo-600 border-indigo-600 hover:text-white hover:bg-indigo-600"
        >
          Go back
        </button>
      </div>
    </div>

    <AdminFormComponent
      v-if="showAdminFormComponent"
      :close="closeAdminFormComponent"
      :adminEntity="admin"
      :create="false"
      :adminListing="getAdmin"
    />
  </div>
</template>

<script>
import AdminFormComponent from "../../../components/admin/AdminFormComponent";

export default {
  name: 'Admin',
  data () {
    return {
      loading: false,
      admin: null,
      showAdminFormComponent: false
    }
  },
  methods: {
    deleteAdmin () {
      if (confirm('Are you sur ?')) {
        this.$store.dispatch('deleteOneAdmin', this.admin).finally(() => {
          this.$store.dispatch('getAllAdmins').finally(() => {
            this.$router.go(-1)
          })
        })
      }
    },
    openAdminFormComponent () {
      this.showAdminFormComponent = true
    },
    closeAdminFormComponent () {
      this.showAdminFormComponent = false
    },
    getAdmin () {
      this.loading = false
      this.$store
        .dispatch('getOneAdmin', this.$route.params.id)
        .then(response => {
          this.loading = true
          this.admin = response.data.data
        })
    }
  },
  created () {
    this.getAdmin()
  },
  components: {
    AdminFormComponent
  }
}
</script>

<style></style>
