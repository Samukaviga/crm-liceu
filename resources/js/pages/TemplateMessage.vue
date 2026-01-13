<template>

    <AppLayout>

         <div v-if="showSuccess" id="alert-1"
            class="flex items-center p-4 mx-5 mt-5 mb-2 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ success }}
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




        <div v-if="statusError" id="alert-1"
            class="flex items-center p-4 mx-5 mt-5 mb-2 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 flex flex-col gap-2 text-sm font-medium">
                <p v-for="msg in messageError" :key="msg">{{ msg }}</p>
            </div>

            <button @click="closeAlert" type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>


        <section class="bg-white py-8 antialiased dark:bg-black md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="flex flex-col items-center mx-auto max-w-5xl">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                        Adicionar Novo Template
                    </h2>

                    <div class="mt-6 sm:mt-8 lg:flex lg:items-center lg:gap-12">
                        <form @submit.prevent="handleSubmit"
                            class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-black sm:p-6 lg:max-w-xl lg:p-8">


                            <div class="mb-6">
                                <label for="school"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Selecione a Escola
                                </label>
                                <select v-model="registerForm.school_id" required id="school"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled>Escolha a escola</option>
                                    <option v-for="school in schools" :key="school.id" :value="school.id">
                                        {{ school.name }}
                                    </option>

                                </select>

                            </div>

                            <div class="mb-6">
                                <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nome do Template
                                </label>
                                <Input type="text" v-model="registerForm.name" />
                            </div>

                            <div class="mb-6">
                                <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Numero do template
                                </label>
                                <Input type="text" v-model="registerForm.number" />
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




    </AppLayout>

</template>

<script setup lang="ts">


import { reactive, ref, computed } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
//import axios from 'axios'

import { Input } from '@/components/ui/input'
import { usePage, router } from '@inertiajs/vue3'
const { props } = usePage()
const page = usePage()

const showSuccess = ref(false)

const success = computed(() =>
    showSuccess.value ? page.props.flash?.success : null
)


let loading = ref(false);
let messageError = ref('');
let statusError = ref(false);


const schools = props.schools;

type Template = {
    school_id: number | null;
    number: string;
    name: string;
}

const registerForm = reactive<Template>({
    school_id: null,
    number: '',
    name: '',
})


function closeAlert() {
    statusError.value = false;
    messageError.value = '';
    showSuccess.value = false;
}

async function handleSubmit() {

    try {
        loading.value = true;

        router.post('/templates', registerForm, {
            onFinish: () => {
                loading.value = false
            },
            onError: (error) => {
                statusError.value = true;
                messageError.value = Object.values(error);
            },
            onSuccess: () => {
                registerForm.school_id = null;
                registerForm.name = '';
                registerForm.number = '';
            }
        })

    } catch (error) {
        console.error('Erro ao enviar o formulário:', error);
    }

}



</script>
