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
                  <div class="flex flex-col pt-4">
                    <label for="name" class="text-lg"
                      >Name <span class="text-red-600">*</span></label
                    >
                    <input
                      v-model="speciality.name"
                      required
                      type="text"
                      id="name"
                      placeholder="name"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>
                  <div class="flex flex-col pt-4">
                    <label for="name" class="text-lg">Description</label>
                    <textarea
                      v-model="speciality.description"
                      type="text"
                      id="description"
                      placeholder="description"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>
                  <div class="flex flex-col pt-4">
                    <label for="name" class="text-lg">Keywords</label>
                   <div class="flex">
                     <select
                        v-model="keywordSelected"
                        class="form-multiselect block w-full mt-1 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                      >
                        <option :disabled="checkIfKeywordAlreadyAdd(keyword)" :value="keyword.name" v-for="(keyword, idx) in keywords" :key="idx">{{keyword.name}}</option>
                      </select>
                      <button @click.prevent="addKeyword()" :disabled="!keywordSelected" class="ml-2 text-indigo-600 disabled:opacity-50"><i class="fas fa-plus"></i></button>
                     </div>
                    <div class="mt-3">
                      <span
                        v-for="(keyword, idx) in speciality.keywords"
                        :key="idx"
                        class="inline-flex items-center justify-center px-2 py-2 mr-2 text-xs leading-none text-gray-900 bg-gray-200 rounded-full mt-1"
                        >{{ keyword.name }} <button @click.prevent="removeKeyword(keyword)" type="button" class="ml-2"><i class="fas fa-times"></i></button></span
                      >
                    </div>
                    <!--<label class="block">
                      <span class="text-gray-700">Keywords</span>
                      <select
                        v-model="speciality.keywords"
                        class="form-multiselect block w-full mt-1 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                        multiple
                      >
                        <option :value="keyword.name" v-for="(keyword, idx) in keywords" :key="idx">{{keyword.name}}</option>
                      </select>
                    </label>-->
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
  name: 'SpecialityFormComponent',
  data () {
    return {
      speciality: this.specialityEntity,
      keywordSelected: null
    }
  },
  methods: {
    save () {
      const keywords = []
      this.speciality.keywords.forEach(keyword => {
        keywords.push(keyword.name)
      })
      this.speciality.keywords = keywords

      if (this.create) {
        this.$store
          .dispatch('newSpeciality', this.speciality)
          .then(response => {
            this.specialityListing()
            this.close()
          })
      } else {
        this.$store
          .dispatch('updateOneSpeciality', this.speciality)
          .then(response => {
            this.specialityListing()
            this.close()
          })
      }
    },
    removeKeyword (keyword) {
      this.speciality.keywords = this.speciality.keywords.filter(item => item.id !== keyword.id)
    },
    addKeyword () {
      this.speciality.keywords.push(this.keywords.filter(item => item.name === this.keywordSelected)[0])
    },
    checkIfKeywordAlreadyAdd (keyword) {
      const keywordFiltered = this.speciality.keywords.filter(item => item.id === keyword.id)
      if (keywordFiltered.length) { return true } else { return false }
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
    specialityEntity: {
      type: Object,
      required: true
    },
    specialityListing: {
      type: Function,
      required: false
    }
  },
  computed: {
    formTitle () {
      if (this.create) {
        return 'New speciality'
      } else {
        return 'Edit speciality'
      }
    },
    formValid () {
      if (this.create) {
        return !this.speciality.name
      } else {
        return false
      }
    },
    keywords () {
      return this.$store.getters.get_keywords
    }
  },
  mounted () {
    if (!this.keywords.length) {
      this.$store.dispatch('getAllKeywords')
    }
  }
}
</script>

<style></style>
