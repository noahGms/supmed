<template>
  <div v-if="user" class="container w-full flex justify-center flex-wrap mx-auto px-8">
    <div class="flex w-full flex-wrap justify-between items-center">
      <p class="text-base font-bold text-gray-700 py-2">Profile</p>
      <button @click="openProfileFormComponent" class="rounded mr-6 text-indigo-600">
        <i class="fas fa-edit"></i> Edit my profile
      </button>
    </div>
    <div class="mt-10 w-full rounded overflow-hidden shadow-lg">
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-6">{{ user.fullname }}</div>
        <p class="text-gray-700 text-base mb-2">
          <span class="font-bold">Email: </span>{{ user.email }}
        </p>
        <p class="text-gray-700 text-base mb-2">
          <span class="font-bold">Firstname: </span>{{ user.firstname }}
        </p>
        <p class="text-gray-700 text-base mb-2">
          <span class="font-bold">Lastname: </span>{{ user.lastname }}
        </p>
        <p class="text-gray-700 text-base mb-2">
          <span class="font-bold">Phone number: </span>{{ user.phone }}
        </p>
        <p class="text-gray-700 text-base mb-2">
          <span class="font-bold">Address: </span>{{ user.address.fulladdress }}
        </p>
      </div>
      <!--<div class="px-6 pb-4">
        <button class="mt-6 rounded text-indigo-600 ">
          <i class="fas fa-key mr-3"></i> Change my password
        </button>
      </div>-->
    </div>
    <ProfileFormComponent
      v-if="showProfileFormComponent"
      :userEntity="user"
      :close="closeProfileFormComponent"
      :userListing="() => $store.dispatch('whoami')"
    />
  </div>
</template>

<script>
import ProfileFormComponent from "../../components/ProfileFormComponent";

export default {
  name: 'Profile',
  data () {
    return {
      showProfileFormComponent: false
    }
  },
  methods: {
    openProfileFormComponent () {
      this.showProfileFormComponent = true
    },
    closeProfileFormComponent () {
      this.showProfileFormComponent = false
    }
  },
  computed: {
    user () {
      return this.$store.getters.get_user
    }
  },
  components: {
    ProfileFormComponent
  }
}
</script>

<style scoped>
.custom-height {
  height: calc(100vh - (140px + 84px));
}
</style>
