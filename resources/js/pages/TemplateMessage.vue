<template>

    <AppLayout>

        <SuccessMessage v-if="showSuccess && success" :message="success" @close="closeAlert" />

        <ErrorMessage v-if="statusError" :message="messageError" @close="closeAlert" />

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
import { Input } from '@/components/ui/input'
import { usePage, router } from '@inertiajs/vue3'
import SuccessMessage from '@/components/ui/alert/SuccessMessage.vue'
import ErrorMessage from '@/components/ui/alert/ErrorMessage.vue'
import Button from '@/components/ui/button/Button.vue'


const { props } = usePage()
const page = usePage()
const schools = props.schools;
const showSuccess = ref(true)

const success = computed(() =>
    showSuccess.value ? page.props.flash?.success : null
)

let loading = ref(false);
let messageError = ref('');
let statusError = ref(false);


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
