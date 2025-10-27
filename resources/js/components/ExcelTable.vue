<template>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">Value</th>
          <th scope="col" class="px-6 py-3">Project Id</th>
          <th scope="col" class="px-6 py-3">Description</th>
          <th scope="col" class="px-6 py-3">Type</th>
          <th scope="col" class="px-6 py-3">Created At</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(value, index) in paginatedData"
          :key="index"
          class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
        >
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ value.value }}
          </th>
          <td class="px-6 py-4">{{ value.project_id }}</td>
          <td class="px-6 py-4">{{ value.description }}</td>
          <td class="px-6 py-4">{{ value.type }}</td>
          <td class="px-6 py-4">{{ value.created_at_sellflux }}</td>
        </tr>
      </tbody>
    </table>

    <!-- Paginação -->
    <nav
      class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
      aria-label="Table navigation"
    >
      <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
        Mostrando
        <span class="font-semibold text-gray-900 dark:text-white">{{ startItem }}</span>-
        <span class="font-semibold text-gray-900 dark:text-white">{{ endItem }}</span>
        de
        <span class="font-semibold text-gray-900 dark:text-white">{{ totalItems }}</span>
      </span>

      <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
        <li>
          <button
            @click="previousPage"
            :disabled="currentPage === 1"
            class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 disabled:opacity-50 dark:hover:bg-gray-900 dark:hover:text-white"
          >
            Previous
          </button>
        </li>

        <!-- Páginas limitadas -->
        <li v-if="startPage > 1">
          <button
            @click="goToPage(1)"
            class="flex items-center justify-center px-3 h-8 leading-tight border text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-900 dark:hover:text-white"
          >
            1
          </button>
          <span class="px-2 text-gray-400">...</span>
        </li>

        <li v-for="page in visiblePages" :key="page">
          <button
            @click="goToPage(page)"
            class="flex items-center justify-center px-3 h-8 leading-tight border"
            :class="page === currentPage
              ? 'text-blue-600 border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-900 dark:text-white'
              : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-900 dark:hover:text-white'
            "
          >
            {{ page }}
          </button>
        </li>

        <li v-if="endPage < totalPages">
          <span class="px-2 text-gray-400">...</span>
          <button
            @click="goToPage(totalPages)"
            class="flex items-center justify-center px-3 h-8 leading-tight border text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-900 dark:hover:text-white"
          >
            {{ totalPages }}
          </button>
        </li>

        <li>
          <button
            @click="nextPage"
            :disabled="currentPage === totalPages"
            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400 disabled:opacity-50 dark:hover:bg-gray-900 dark:hover:text-white"
          >
            Next
          </button>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script lang="ts">
export default {
  name: 'ExcelTable',

  props: {
    data: {
      type: Array,
      required: true,
    },
    perPage: {
      type: Number,
      default: 10,
    },
  },

  data() {
    return {
      currentPage: 1,
      maxVisiblePages: 5, // máximo de páginas visíveis no menu
    }
  },

  computed: {
    totalItems() {
      return this.data.length
    },
    totalPages() {
      return Math.ceil(this.totalItems / this.perPage)
    },
    startItem() {
      return (this.currentPage - 1) * this.perPage + 1
    },
    endItem() {
      return Math.min(this.startItem + this.perPage - 1, this.totalItems)
    },
    paginatedData() {
      const start = (this.currentPage - 1) * this.perPage
      const end = start + this.perPage
      return this.data.slice(start, end)
    },

    // Cálculo de páginas visíveis
    startPage() {
      const half = Math.floor(this.maxVisiblePages / 2)
      if (this.currentPage <= half) return 1
      if (this.currentPage + half >= this.totalPages) return Math.max(this.totalPages - this.maxVisiblePages + 1, 1)
      return this.currentPage - half
    },
    endPage() {
      return Math.min(this.startPage + this.maxVisiblePages - 1, this.totalPages)
    },
    visiblePages() {
      const pages = []
      for (let i = this.startPage; i <= this.endPage; i++) {
        pages.push(i)
      }
      return pages
    },
  },

  methods: {
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++
      }
    },
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--
      }
    },
    goToPage(page: number) {
      this.currentPage = page
    },
  },
}
</script>
