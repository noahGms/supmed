<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <div
    class="fixed z-20 inset-0 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
  >
    <div
      class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <div
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        aria-hidden="true"
      ></div>

      <span
        class="hidden sm:inline-block sm:align-middle sm:h-screen"
        aria-hidden="true"
        >&#8203;</span
      >

      <div
        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
      >
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3
                class="text-lg leading-6 font-medium text-gray-900"
                id="modal-title"
              >
                {{ formTitle }}
              </h3>
              <div class="mt-2">
                <form class="flex flex-col">
                  <div class="flex flex-col pt-4" v-if="create">
                    <label for="email" class="text-lg"
                      >Email <span class="text-red-600">*</span></label
                    >
                    <input
                      v-model="admin.email"
                      required
                      type="email"
                      id="email"
                      placeholder="your@email.com"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>

                  <div class="flex flex-col pt-4" v-if="create">
                    <label for="password" class="text-lg"
                      >Password <span class="text-red-600">*</span></label
                    >
                    <input
                      v-model="admin.password"
                      required
                      type="password"
                      id="password"
                      placeholder="Password"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>

                  <div class="flex flex-col pt-4" v-if="create">
                    <label for="confirm-password" class="text-lg"
                      >Confirm password
                      <span class="text-red-600">*</span></label
                    >
                    <input
                      v-model="admin.password_confirmation"
                      required
                      type="password"
                      id="confirm-password"
                      placeholder="Password"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>

                  <div class="flex flex-col pt-4">
                    <label for="firstname" class="text-lg">Firstname</label>
                    <input
                      v-model="admin.firstname"
                      type="text"
                      id="firstname"
                      placeholder="John"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>

                  <div class="flex flex-col pt-4">
                    <label for="lastname" class="text-lg">Lastname</label>
                    <input
                      v-model="admin.lastname"
                      type="text"
                      id="lastname"
                      placeholder="Smith"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>

                  <div class="flex flex-col pt-4">
                    <label for="phone" class="text-lg">Phone number</label>
                    <input
                      v-model="admin.phone"
                      type="text"
                      id="phone"
                      placeholder="0634564589"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>

                  <div class="flex flex-row pt-4">
                    <div class="w-40 mr-4">
                      <label for="street_number" class="text-lg"
                        >Street number</label
                      >
                      <input
                        v-model="admin.address.street_number"
                        type="number"
                        id="street_number"
                        placeholder="200"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                      />
                    </div>
                    <div>
                      <label for="street_name" class="text-lg"
                        >Street name</label
                      >
                      <input
                        v-model="admin.address.street_name"
                        type="text"
                        id="street_name"
                        placeholder="Rue des fleurs"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                      />
                    </div>
                  </div>

                  <div class="flex flex-row pt-4">
                    <div class="w-40 mr-4">
                      <label for="zipcode" class="text-lg">Zipcode</label>
                      <input
                        v-model="admin.address.zipcode"
                        type="number"
                        id="zipcode"
                        placeholder="69007"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                      />
                    </div>
                    <div>
                      <label for="city" class="text-lg">City</label>
                      <input
                        v-model="admin.address.city"
                        type="text"
                        id="city"
                        placeholder="Lyon"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                      />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button
            :disabled="formValid"
            @click="save"
            type="button"
            class="w-full inline-flex disabled:opacity-50 justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
          >
            Save
          </button>
          <button
            @click="close"
            type="button"
            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminFormComponent',
  data () {
    return {
      admin: this.adminEntity
    }
  },
  methods: {
    save () {
      if (this.create) {
        this.$store.dispatch('newAdmin', this.admin).then(response => {
          this.adminListing()
          this.close()
        })
      } else {
        this.$store.dispatch('updateOneAdmin', this.admin).then(response => {
          this.adminListing()
          this.close()
        })
      }
    }
  },
  props: {
    close: {
      type: Function,
      required: false
    },
    create: {
      type: Boolean,
      required: false,
      default: true
    },
    adminEntity: {
      type: Object,
      required: true
    },
    adminListing: {
      type: Function,
      required: false
    }
  },
  computed: {
    formTitle () {
      if (this.create) {
        return 'New admin'
      } else {
        return 'Edit admin'
      }
    },
    formValid () {
      if (this.create) {
        return !(
          !!this.admin.email &&
          !!this.admin.password &&
          !!this.admin.password_confirmation
        )
      } else {
        return false
      }
    }
  }
}
</script>

<style></style>
