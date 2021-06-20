<template>
  <div v-if="loading" class="text-gray-600 body-font">
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-xl font-bold">Manage keywords</h1>
      <button
        @click="openKeywordFormComponent({}, true)"
        class="rounded text-indigo-600"
      >
        <i class="fas fa-plus"></i> New keyword
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
          <template v-if="keywords.length">
            <tr v-for="(keyword, idx) in keywords" :key="idx">
              <td class="border-t-2 border-gray-200 px-4 py-3">
                {{ keyword.name }}
              </td>
              <td class="border-t-2 border-gray-200 text-center">
                <button
                  @click="openKeywordFormComponent(keyword, false)"
                  class="text-indigo-600 p-2"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button @click="deleteKeyword(keyword)" class="text-red-600 p-2">
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
                <p class="font-bold">No keywords found</p>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
    <KeywordFormComponent
      v-if="showKeywordFormComponent"
      :close="closeKeywordFormComponent"
      :keywordEntity="keyword"
      :create="create"
      :keywordListing="() => this.$store.dispatch('getAllKeywords')"
    />
  </div>
</template>

<script>
import KeywordFormComponent from "../../components/admin/KeywordFormComponent";

export default {
  name: 'Keywords',
  data () {
    return {
      loading: false,
      showKeywordFormComponent: false,
      create: true,
      keyword: {}
    }
  },
  methods: {
    deleteKeyword (keyword) {
      if (confirm('Are you sur ?')) {
        this.$store.dispatch('deleteOneKeyword', keyword).finally(() => {
          this.loading = false
          this.$store.dispatch('getAllKeywords').finally(() => {
            this.loading = true
          })
        })
      }
    },
    openKeywordFormComponent (keyword = {}, create = true) {
      this.showKeywordFormComponent = true
      this.keyword = keyword
      this.create = create
    },
    closeKeywordFormComponent () {
      this.showKeywordFormComponent = false
      this.keyword = {}
    }
  },
  computed: {
    keywords () {
      return this.$store.getters.get_keywords
    }
  },
  created () {
    this.loading = false
    this.$store.dispatch('getAllKeywords').finally(() => {
      this.loading = true
    })
  },
  components: {
    KeywordFormComponent
  }
}
</script>

<style>

</style>
