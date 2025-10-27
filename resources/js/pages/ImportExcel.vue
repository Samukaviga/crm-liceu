<template>

    <AppLayout>

        <div class=" max-w-7xl flex gap-2 mt-4 mx-4">
            <div class="text-center max-w-xs p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                Arquivos em fila: {{ jobs_count }}
            </div>

            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                {{ jobs_failed > 0 ? `Importações com falha: ${jobs_failed}` : 'Nenhuma importação com falha.' }}
            </div>
        </div>

        <div v-if="test" class="text-center max-w-xs p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            Completed
        </div>



        <section class="bg-white py-8 antialiased dark:bg-black md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="flex flex-col items-center mx-auto max-w-5xl">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Import Excel</h2>

                    <div class="mt-6 sm:mt-8 lg:flex lg:items-center lg:gap-12">
                        <form @submit.prevent="submitForm"
                            class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-black sm:p-6 lg:max-w-xl lg:p-8">

                            <div class="mb-6">
                                <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Importar arquivo Excel
                                </label>
                                <input id="file" type="file" @change="handleFileUpload" accept=".xlsx,.xls,.csv"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-black dark:border-gray-600 dark:placeholder-gray-400" />
                            </div>

                            <button type="submit" :disabled="loading"
                                class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-900 dark:hover:bg-blue-800 dark:focus:ring-blue-800">
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


//import ExcelTable from '@/components/ExcelTable.vue';
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
            data: [],
            jobs_count: 0,
            jobs_failed: 0,
            test: false
        }
    },


    mounted() {
        this.getData(); // pega os dados atuais da API

        // listener WebSocket
        if (window.Echo) {
            window.Echo.channel('test-channel')
                .listen('TestEvent', (e: any) => {
                    this.test = true;
                    console.log('Recebido via WebSocket:');
                    if (e.pending_jobs !== undefined) this.jobs_count = e.pending_jobs;
                    if (e.failed_jobs !== undefined) this.jobs_failed = e.failed_jobs;
                });
        }
    },

    methods: {


        async getData() {
            try {
                const response = await axios.get(`${import.meta.env.VITE_API_URL}/api/crm/data`)
                console.log(response.data)
                this.data = response.data.records
                this.jobs_count = response.data.pending_jobs
                this.jobs_failed = response.data.failed_jobs

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
                const response = await axios.post(`${import.meta.env.VITE_API_URL}/api/crm/upload`, formData, {
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
