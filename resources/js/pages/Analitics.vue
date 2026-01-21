<template>

    <AppLayout>

        <section class="bg-white py-8 antialiased dark:bg-black md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="flex flex-col items-center mx-auto max-w-5xl">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5 sm:text-2xl">
                        Lista Analitics
                    </h2>

                    <div class="flex w-full flex-col gap-6">

                        <Table>
                            <TableCaption>Lista dos templates.</TableCaption>
                            <TableHeader>
                                <TableRow>
                                    <TableHead class="w-[100px]">
                                        Template
                                    </TableHead>
                                    <TableHead>Data inicio</TableHead>
                                    <TableHead>Data termino</TableHead>
                                    <TableHead>Envio</TableHead>
                                    <TableHead>Recebido</TableHead>
                                    <TableHead>Lido</TableHead>
                                    <TableHead>Respondeu</TableHead>
                                    <TableHead>Valor gasto</TableHead>
                                    <TableHead>Custo por entrega</TableHead>
                                    <TableHead>Custo por click botao</TableHead>

                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="analitic in analitics.data" :key="analitic.id">
                                    <TableCell class="font-medium">
                                        {{ analitic.template.name }}
                                    </TableCell>
                                    <TableCell>{{ analitic.start_date }}</TableCell>
                                    <TableCell>{{ analitic.end_date }}</TableCell>
                                    <TableCell>{{ analitic.send }}</TableCell>
                                    <TableCell>{{ analitic.delivery }}</TableCell>
                                    <TableCell>{{ analitic.read }}</TableCell>
                                    <TableCell>{{ analitic.replied }}</TableCell>
                                    <TableCell>{{ analitic.amount_spent }}</TableCell>
                                    <TableCell>{{ analitic.cost_per_delivered }}</TableCell>
                                    <TableCell>{{ analitic.cost_url_button_click }}</TableCell>

                                </TableRow>
                            </TableBody>
                            <TableFooter>
                                <TableRow>
                                    <TableCell colspan="20">
                                        <div class="flex flex-col gap-6">
                                            <TableRow>
                                                <TableCell colspan="20">
                                                    <div class="flex flex-wrap justify-center gap-2">
                                                        <template v-for="link in analitics.links" :key="link.label">
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
import { Link } from '@inertiajs/vue3'


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

const props = defineProps(['analitics'])


</script>
