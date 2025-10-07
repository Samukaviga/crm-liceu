<template>

    <AppLayout>

        <section class="bg-white py-8 antialiased dark:bg-black md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="flex flex-col items-center mx-auto max-w-5xl">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Import Excel</h2>

                    <div class="mt-6 sm:mt-8 lg:flex lg:items-center lg:gap-12">
                        <form @submit.prevent="submitForm"
                            class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900 sm:p-6 lg:max-w-xl lg:p-8">

                            <div class="mb-6">
                                <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Importar arquivo Excel
                                </label>
                                <input id="file" type="file" @change="handleFileUpload" accept=".xlsx,.xls,.csv"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400" />
                            </div>

                            <button type="submit" :disabled="loading"
                                class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                {{ loading ? 'Enviando...' : 'Importar' }}
                            </button>

                        </form>



                    </div>

                </div>
            </div>
        </section>

        <div class=" max-w-7xl px-4 sm:px-6 lg:px-8 mb-8">
            <ExcelTable :data="data" />
        </div>


    </AppLayout>

</template>

<script lang="ts">


import ExcelTable from '@/components/ExcelTable.vue';

import AppLayout from '@/layouts/AppLayout.vue'
import axios from 'axios'

export default {
    name: 'ImportExcel',
    components: { AppLayout, ExcelTable },

    data() {
        return {
            file: null,
            loading: false,
            message: '',
            data: []
        }
    },


    mounted() {
         this.getData();
    },

    methods: {


        async getData() {
            try {
                const response = await axios.get('/api/crm/data')
                console.log(response.data)
                this.data = response.data

            } catch (error) {
                console.error('Erro ao buscar dados:', error)
            }
        },

        handleFileUpload(event) {
            this.file = event.target.files[0]
        },

        async submitForm() {
            if (!this.file) {
                alert('Por favor, selecione um arquivo Excel primeiro.')
                return
            }

            this.loading = true
            const formData = new FormData()
            formData.append('file', this.file)

            try {
                const response = await axios.post('/api/crm/upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })

                this.message = response.data.message
                alert(this.message)
                //console.log(this.message)

            } catch (error) {
                console.error('Erro ao enviar o arquivo:', error)
                alert('Erro ao enviar o arquivo.')
            } finally {
                this.loading = false
            }
        },
    },
}
</script>
