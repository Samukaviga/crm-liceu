<template>

    <AppLayout>

        <section class="bg-white py-8 antialiased dark:bg-black md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mx-auto max-w-5xl">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Import Excel</h2>

                    <div class="mt-6 sm:mt-8 lg:flex lg:items-center lg:gap-12">
                        <form @submit.prevent="submit"
                            class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-700 sm:p-6 lg:max-w-xl lg:p-8">
                            <div class="mb-6 grid grid-cols-2 gap-4">


                                <div class="mb-6">
                                    <label for="file"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Importar arquivo Excel
                                    </label>
                                    <input id="file" type="file" @change="handleFileChange"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                                </div>



                            </div>

                            <button type="submit" :disabled="form.processing"
                                class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                {{ form.processing ? 'Importando...' : 'Importar' }}
                            </button>

                        </form>


                    </div>

                </div>
            </div>
        </section>



    </AppLayout>

</template>

<script lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'

export default {
    name: 'ImportExcel',
    components: { AppLayout },

    data() {
        return {
            // cria o formulário reativo do Inertia
            form: useForm({
                file: null,
            }),
        }
    },

    methods: {

        handleFileChange(event) {
            const file = event.target.files[0]
            this.form.file = file
            console.log(file)
        },

        submit() {
            this.form.post(route('excel.import'), {
                forceFormData: true,
                onSuccess: () => {
                    alert('Arquivo importado com sucesso!')
                    this.form.reset()
                },
            })
        },

    },

}
</script>
