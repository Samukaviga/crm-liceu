<template>

    <AppLayout>

        <SuccessMessage v-if="showSuccess && success" :message="success" @close="closeAlert" />

        <section class="bg-white py-8 antialiased dark:bg-black md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="flex flex-col items-center mx-auto max-w-5xl">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5 sm:text-2xl">
                        Lista de Templates
                    </h2>

                    <div class="flex w-full flex-col gap-6">

                        <Table>
                            <TableCaption>Lista dos templates.</TableCaption>
                            <TableHeader>
                                <TableRow>
                                    <TableHead class="w-[100px]">
                                        Escola
                                    </TableHead>
                                    <TableHead>Nome</TableHead>
                                    <TableHead>Numero</TableHead>
                                    <TableHead>Tipo</TableHead>
                                    <TableHead>Campanha</TableHead>
                                    <TableHead>Categoria</TableHead>
                                    <TableHead class="text-end">--</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="template in templates.data" :key="template.id">
                                    <TableCell class="font-medium">
                                        {{ template.school.name }}
                                    </TableCell>
                                    <TableCell>{{ template.name }}</TableCell>
                                    <TableCell>{{ template.number }}</TableCell>
                                    <TableCell>{{ template.type }}</TableCell>
                                    <TableCell>{{ template.campaign }}</TableCell>
                                    <TableCell>{{ template.category }}</TableCell>
                                    <TableCell class="flex gap-2 justify-end">


                                        <Link :href="`/templates/${template.id}/edit`"
                                            class="inline-flex items-center bg-blue-400 hover:bg-blue-500 px-4 py-2 rounded text-white">
                                            Editar
                                        </Link>

                                        <Button class="bg-red-400 hover:bg-red-500" @click="destroy(template.id)">
                                            Excluir
                                        </Button>

                                    </TableCell>
                                </TableRow>
                            </TableBody>
                            <TableFooter>
                                <TableRow>
                                    <TableCell colspan="3">
                                        <div class="flex flex-col gap-6">
                                            <TableRow>
                                                <TableCell colspan="5">
                                                    <div class="flex flex-wrap justify-center gap-2">
                                                        <template v-for="link in templates.links" :key="link.label">
                                                            <Link v-if="link.url" :href="link.url" v-html="link.label"
                                                                class="px-3 py-1 text-sm border rounded"
                                                                :class="{ 'bg-black text-white': link.active }" />

                                                            <span v-else v-html="link.label"
                                                                class="px-3 py-1 text-sm border rounded text-gray-400 cursor-not-allowed" />
                                                        </template>
                                                    </div>
                                                </TableCell>
                                            </TableRow>
                                        </div>
                                    </TableCell>
                                </TableRow>
                            </TableFooter>
                        </Table>

                    </div>

                </div>
            </div>
        </section>


    </AppLayout>

</template>

<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue'
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import Button from '@/components/ui/button/Button.vue';
import { router, usePage } from '@inertiajs/vue3'
import SuccessMessage from '@/components/ui/alert/SuccessMessage.vue';

import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableFooter,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'



const page = usePage()

const props = defineProps(['templates'])
const showSuccess = ref(true)

const success = computed(() =>
    showSuccess.value ? page.props.flash?.success : null
)


console.log(props.templates);


async function destroy(id: number) {
    if (confirm('Tem certeza que deseja excluir este template?')) {
        router.delete(`/templates/${id}`);
    }
}

function closeAlert() {
    showSuccess.value = false;
}

</script>
