<template>

    <AppLayout>


        <section class="bg-white py-8 antialiased dark:bg-black md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="flex flex-col items-center mx-auto max-w-5xl">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                        Lista de Templates
                    </h2>


                    <div class="flex w-full flex-col gap-6">

                        <Table>
                            <TableCaption>A list of your recent invoices.</TableCaption>
                            <TableHeader>
                                <TableRow>
                                    <TableHead class="w-[100px]">
                                        Nome Template
                                    </TableHead>
                                    <TableHead>Numero</TableHead>
                                    <TableHead>Campanha</TableHead>
                                    <TableHead>
                                        Categoria
                                    </TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="template in templates.data" :key="template.id">
                                    <TableCell class="font-medium">
                                        {{ template.name }}
                                    </TableCell>
                                    <TableCell>{{ template.number }}</TableCell>
                                    <TableCell>{{ template.campaign }}</TableCell>
                                    <TableCell>
                                        {{ template.category }}
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


const props = defineProps(['templates'])




</script>
