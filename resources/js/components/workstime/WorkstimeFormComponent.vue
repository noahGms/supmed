<template>
  <div
    class="fixed z-10 inset-0 overflow-y-auto"
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
                {{formTitle}}
              </h3>
              <div class="mt-2">
                <form class="flex flex-col">
                  <div class="flex flex-col pt-4">
                    <label for="start_date" class="text-lg">Start date</label>
                    <input
                      v-model="workstime.start_date"
                      type="date"
                      id="start_date"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>

                  <div class="flex flex-col pt-4">
                    <label for="start_time" class="text-lg">Start time</label>
                    <input
                      v-model="workstime.start_time"
                      type="time"
                      id="start_time"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>

                  <div class="flex flex-col pt-4">
                    <label for="end_date" class="text-lg">End date</label>
                    <input
                      v-model="workstime.end_date"
                      type="date"
                      id="end_date"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
                  </div>

                  <div class="flex flex-col pt-4">
                    <label for="end_time" class="text-lg">End time</label>
                    <input
                      v-model="workstime.end_time"
                      type="time"
                      id="end_time"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                    />
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
  name: 'WorkstimeFormComponent',
  data () {
    return {
      workstime: this.workstimeEntity
    }
  },
  methods: {
    save () {
      if (this.create) {
        this.$store.dispatch('newWorkstime', {
          docId: this.user.id,
          workstime: {
            start_date: `${this.workstime.start_date} ${this.workstime.start_time}`,
            end_date: `${this.workstime.end_date} ${this.workstime.end_time}`
          }
        }).then(response => {
          this.workstimeListing()
          this.close()
        })
      } else {
        this.$store.dispatch('updateOneWorkstime', {
          docId: this.user.id,
          workstime: {
            id: this.workstime.id,
            start_date: `${this.workstime.start_date} ${this.workstime.start_time}`,
            end_date: `${this.workstime.end_date} ${this.workstime.end_time}`
          }
        }).then(response => {
          this.workstimeListing()
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
    workstimeListing: {
      type: Function,
      required: false
    },
    user: {
      type: Object,
      required: true
    },
    workstimeEntity: {
      type: Object,
      required: true
    },
    create: {
      type: Boolean,
      required: false,
      default: true
    }
  },
  computed: {
    formTitle () {
      if (this.create) {
        return 'New workstime'
      } else {
        return 'Edit workstime'
      }
    },
    formValid () {
      if (this.create) {
        return !(
          !!this.workstime.start_date &&
          !!this.workstime.start_time &&
          !!this.workstime.end_date &&
          !!this.workstime.end_time
        )
      } else {
        return false
      }
    }
  }
}
</script>

<style></style>
