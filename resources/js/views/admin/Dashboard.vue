<template>
  <div class="container w-full flex flex-wrap mx-auto px-2">
    <div
      class="w-1/5 hidden md:block lg:block px-6 text-xl text-gray-800 leading-normal"
    >
      <p class="text-base font-bold py-2 lg:pb-6 text-gray-700">Admin</p>
      <div
        class="w-full sticky inset-0  h-64 lg:h-auto  lg:overflow-y-hidden lg:block mt-0 z-20"
        style="top:5em;"
        id="menu-content"
      >
        <ul class="list-reset">
          <li class="py-2 md:my-0 hover:bg-indigo-100 lg:hover:bg-transparent">
            <router-link
              active-class="border-indigo-500 hover:border-indigo-500 text-gray-900 font-bold"
              :to="{ name: 'admin_doctors' }"
              class="block pl-4 align-middle text-gray-700 no-underline hover:text-indigo-500 border-l-4 border-transparent"
            >
              <span class="pb-1 md:pb-0 text-sm">Doctors</span>
            </router-link>
          </li>
          <li class="py-2 md:my-0 hover:bg-indigo-100 lg:hover:bg-transparent">
            <router-link
              active-class="border-indigo-500 hover:border-indigo-500 text-gray-900 font-bold"
              :to="{ name: 'admin_patients' }"
              class="block pl-4 align-middle text-gray-700 no-underline hover:text-indigo-500 border-l-4 border-transparent lg:hover:border-gray-400"
            >
              <span class="pb-1 md:pb-0 text-sm">Patients</span>
            </router-link>
          </li>
          <li class="py-2 md:my-0 hover:bg-indigo-100 lg:hover:bg-transparent">
            <router-link
              active-class="border-indigo-500 hover:border-indigo-500 text-gray-900 font-bold"
              :to="{ name: 'admin_admins' }"
              class="block pl-4 align-middle text-gray-700 no-underline hover:text-indigo-500 border-l-4 border-transparent lg:hover:border-gray-400"
            >
              <span class="pb-1 md:pb-0 text-sm">Admins</span>
            </router-link>
          </li>
          <li class="py-2 md:my-0 hover:bg-indigo-100 lg:hover:bg-transparent">
            <router-link
              active-class="border-indigo-500 hover:border-indigo-500 text-gray-900 font-bold"
              :to="{ name: 'admin_specialities' }"
              class="block pl-4 align-middle text-gray-700 no-underline hover:text-indigo-500 border-l-4 border-transparent lg:hover:border-gray-400"
            >
              <span class="pb-1 md:pb-0 text-sm">Specialities</span>
            </router-link>
          </li>
          <li class="py-2 md:my-0 hover:bg-indigo-100 lg:hover:bg-transparent">
            <router-link
              active-class="border-indigo-500 hover:border-indigo-500 text-gray-900 font-bold"
              :to="{ name: 'admin_keywords' }"
              class="block pl-4 align-middle text-gray-700 no-underline hover:text-indigo-500 border-l-4 border-transparent lg:hover:border-gray-400"
            >
              <span class="pb-1 md:pb-0 text-sm">Keywords</span>
            </router-link>
          </li>
          <li class="py-2 md:my-0 hover:bg-indigo-100 lg:hover:bg-transparent">
            <router-link
              active-class="border-indigo-500 hover:border-indigo-500 text-gray-900 font-bold"
              :to="{ name: 'admin_appointmentsTypes' }"
              class="block pl-4 align-middle text-gray-700 no-underline hover:text-indigo-500 border-l-4 border-transparent lg:hover:border-gray-400"
            >
              <span class="pb-1 md:pb-0 text-sm">Appointments Types</span>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
    <div
      class="w-full block md:hidden lg:hidden px-6 text-xl text-gray-800 leading-normal flex justify-start items-center"
    >
      <router-link
        :to="{ name: 'admin_doctors' }"
        class="text-gray-700 no-underline hover:text-indigo-500 hover:bg-indigo-100 p-2 mr-2"
        active-class="bg-indigo-100 hover:border-indigo-500 text-gray-900 font-bold"
      >
        <span class="pb-1 md:pb-0 text-sm">Doctors</span>
      </router-link>
      <router-link
        :to="{ name: 'admin_patients' }"
        class="text-gray-700 no-underline hover:text-indigo-500 hover:bg-indigo-100 p-2 mr-2"
        active-class="bg-indigo-100 hover:border-indigo-500 text-gray-900 font-bold"
      >
        <span class="pb-1 md:pb-0 text-sm">Patients</span>
      </router-link>
      <router-link
        :to="{ name: 'admin_admins' }"
        class="text-gray-700 no-underline hover:text-indigo-500 hover:bg-indigo-100 p-2 mr-2"
        active-class="bg-indigo-100 hover:border-indigo-500 text-gray-900 font-bold"
      >
        <span class="pb-1 md:pb-0 text-sm">Admins</span>
      </router-link>
      <router-link
        :to="{ name: 'admin_specialities' }"
        class="text-gray-700 no-underline hover:text-indigo-500 hover:bg-indigo-100 p-2 mr-2"
        active-class="bg-indigo-100 hover:border-indigo-500 text-gray-900 font-bold"
      >
        <span class="pb-1 md:pb-0 text-sm">Specialities</span>
      </router-link>
      <router-link
        :to="{ name: 'admin_keywords' }"
        class="text-gray-700 no-underline hover:text-indigo-500 hover:bg-indigo-100 p-2"
        active-class="bg-indigo-100 hover:border-indigo-500 text-gray-900 font-bold"
      >
        <span class="pb-1 md:pb-0 text-sm">Keywords</span>
      </router-link>
      <router-link
        :to="{ name: 'admin_appointmentsTypes' }"
        class="text-gray-700 no-underline hover:text-indigo-500 hover:bg-indigo-100 p-2"
        active-class="bg-indigo-100 hover:border-indigo-500 text-gray-900 font-bold"
      >
        <span class="pb-1 md:pb-0 text-sm">Appointments Types</span>
      </router-link>
    </div>
    <div class="w-full lg:w-4/5 md:w-4/5 p-8 mt-6 text-gray-900 leading-normal">
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  name: 'Dashboard',
  created () {
    this.$router.push({ name: 'admin_doctors' })
  }
}
</script>

<style></style>
