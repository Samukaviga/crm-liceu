<template>

    <AppLayout>


        <div v-if="completed" id="alert-1"
            class="flex items-center p-4 mx-5 mt-5 mb-2 text-green-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                Completed
            </div>
            <button @click="closeAlert" type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <div class=" max-w-7xl flex gap-2 mt-2 mx-4">
            <div class="text-center max-w-xs p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                Arquivos em fila: {{ jobs_count }}
            </div>

            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                {{ jobs_failed > 0 ? `Importações com falha: ${jobs_failed}` : 'Nenhuma importação com falha.' }}
            </div>

            <div class="text-center max-w-xs p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                Total de linhas: <span class="font-bold "> {{ total }}</span>
            </div>

        </div>


        <section class="bg-white py-8 antialiased dark:bg-black md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="flex flex-col items-center mx-auto max-w-5xl">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Importar Estatísticas
                        dos Atend.</h2>

                    <div class="mt-6 sm:mt-8 lg:flex lg:items-center lg:gap-12">
                        <form @submit.prevent="submitForm"
                            class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-black sm:p-6 lg:max-w-xl lg:p-8">

                            <div class="mb-6">
                                <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Importar arquivo Excel
                                </label>
                                <input id="file" type="file" @change="handleFileUpload" accept=".xlsx,.xls,.csv"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg p-2  cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-black dark:border-gray-600 dark:placeholder-gray-400" />
                            </div>

                            <div class="mb-6">
                                <label for="school"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Selecione a Escola
                                </label>
                                <select v-model="school" required id="school"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Escolha a escola</option>
                                    <option value="Liceu Itaqua">Liceu Itaqua</option>
                                    <option value="Liceu Suzano">Liceu Suzano</option>
                                    <option value="Liceu Aruja">Liceu Aruja</option>
                                    <option value="Colégio Estação Futura">Colégio Estação Futura</option>
                                    <option value="Colégio Itaqua">Colégio Itaqua</option>
                                    <option value="Colégio Doremi">Colégio Doremi</option>
                                    <option value="Fisk Itaqua">Fisk Itaqua</option>
                                    <option value="Fisk Suzano">Fisk Suzano</option>
                                </select>

                            </div>

                            <button type="submit" :disabled="loading"
                                class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-900 dark:hover:bg-blue-800 dark:focus:ring-blue-800">
                                {{ loading ? 'Enviando...' : 'Importar' }}
                            </button>

                            <div class="text-center max-w-xs p-2 mb-2 mt-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                role="alert">
                                habilite o arquivo para edição antes de importar<span class="font-bold "></span>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </section>

        <div class=" max-w-7xl px-4 sm:px-6 lg:px-8 mb-8">
            <StatisticsTable :data="data" />

        </div>


    </AppLayout>

</template>

<script lang="ts">


//import ExcelTable from '@/components/ExcelTable.vue';
import ExcelTable from '@/components/ExcelTable.vue';
import StatisticsTable from '@/components/StatisticsTable.vue';


import AppLayout from '@/layouts/AppLayout.vue'
import axios from 'axios'


export default {
    name: 'ImportExcel',
    components: { AppLayout, StatisticsTable },

    data() {
        return {
            file: null,
            school: '',
            loading: false,
            message: '',
            data: [],
            jobs_count: 0,
            jobs_failed: 0,
            completed: false,
            total: 0,
        }
    },


    mounted() {
        this.getData(); // pega os dados atuais da API

    },

    methods: {


        closeAlert() {
            this.completed = false;
        },

        async getData() {
            try {
                const response = await axios.get(`${import.meta.env.VITE_API_URL}/api/statistics/data`)
                //console.log(response.data)
                this.data = response.data.records
                this.jobs_count = response.data.pending_jobs
                this.jobs_failed = response.data.failed_jobs
                this.total = response.data.total

            } catch (error) {
                console.error('Erro ao buscar dados:', error)
            }
        },



        async submitForm() {
            if (!this.file) {
                alert('Por favor, selecione um arquivo Excel primeiro.')
                return
            }


            this.loading = true
            const formData = new FormData()
            formData.append('file', this.file)
            formData.append('school', this.school)

            try {
                const response = await axios.post(`${import.meta.env.VITE_API_URL}/api/statistics/upload`, formData, {
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
