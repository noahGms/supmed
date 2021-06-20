<template>
  <div v-if="loading" class="container w-full flex justify-center flex-wrap mx-auto px-8">
    <div class="flex w-full flex-wrap justify-between items-center">
      <p class="text-base font-bold text-gray-700 py-2">Workstimes</p>
      <button @click="openWorkstimeFormComponent({}, true)" class="rounded mr-6 text-indigo-600">
        <i class="fas fa-plus"></i> Add new workstime
      </button>
    </div>
    <div  class="w-full mt-10">
      <vue-cal
        :time-from="5 * 60"
        :time-to="22 * 60"
        :disable-views="['years', 'year', 'month']"
        hide-weekends
        :editable-events="{ title: false, drag: false, resize: false, delete: false, create: false }"
        :events="workstimes"
      >
        <template v-slot:event="{ event }">
          <div class="vuecal__event-title" style="color: black;">
            {{event.start.formatTime('HH:mm')}}-{{event.end.formatTime('HH:mm')}}
            <button @click="openWorkstimeFormComponent(event, false)">
              <i class="fas fa-edit text-indigo-600"></i>
            </button>
            <button @click="deleteEvent(event)">
              <i class="fas fa-trash text-red-600"></i>
            </button>
          </div>
        </template>
      </vue-cal>
    </div>
    <WorkstimeFormComponent
      v-if="showWorkstimeFormComponent"
      :close="closeWorkstimeFormComponent"
      :workstimeListing="workstimeListing"
      :user="user"
      :create="create"
      :workstimeEntity="workstime"
    />
  </div>
</template>

<script>
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'
import { mapGetters } from 'vuex'
import WorkstimeFormComponent from '../../components/workstime/WorkstimeFormComponent'

export default {
  name: 'Workstimes',
  data () {
    return {
      loading: false,
      showWorkstimeFormComponent: false,
      workstime: {}
    }
  },
  methods: {
    workstimeListing () {
      this.loading = false
      this.$store.dispatch('getAllWorkstimes', this.user.id).then(response => {
        this.loading = true
      })
    },
    openWorkstimeFormComponent (workstime = {}, create = true) {
      this.showWorkstimeFormComponent = true
      if (create) {
        this.workstime = workstime
      } else {
        this.workstime = {
          id: workstime.id,
          start_date: workstime.start.format('YYYY-MM-DD'),
          start_time: workstime.start.format('HH:mm'),
          end_date: workstime.end.format('YYYY-MM-DD'),
          end_time: workstime.end.format('HH:mm', 'fr-fr')
        }
      }
      this.create = create
    },
    closeWorkstimeFormComponent () {
      this.showWorkstimeFormComponent = false
      this.workstime = {}
    },
    deleteEvent (event) {
      if (confirm('Are you sure to want delete this workstime ?')) {
        this.$store.dispatch('deleteOneWorkstime', { docId: this.user.id, workstime: event }).then(response => {
          this.workstimeListing()
        })
      }
    }
  },
  computed: {
    ...mapGetters({ user: 'get_user', workstimes: 'get_workstimes' })
  },
  created () {
    this.workstimeListing()
  },
  components: { VueCal, WorkstimeFormComponent }
}
</script>

<style>
.vuecal__event.leisure {background-color: rgba(253, 156, 66, 0.9);border: 1px solid rgb(233, 136, 46);color: #fff;}
.vuecal__event.health {background-color: rgba(164, 230, 210, 0.9);border: 1px solid rgb(144, 210, 190);}
.vuecal__event.sport {background-color: rgba(221, 238, 255, 0.9);border: 1px solid rgb(221, 238, 235,);color: #fff;}
.vuecal__event-time {color: black;}
</style>
