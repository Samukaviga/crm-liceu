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
                                        Invoice
                                    </TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead>Method</TableHead>
                                    <TableHead class="text-right">
                                        Amount
                                    </TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="invoice in invoices" :key="invoice.invoice">
                                    <TableCell class="font-medium">
                                        {{ invoice.invoice }}
                                    </TableCell>
                                    <TableCell>{{ invoice.paymentStatus }}</TableCell>
                                    <TableCell>{{ invoice.paymentMethod }}</TableCell>
                                    <TableCell class="text-right">
                                        {{ invoice.totalAmount }}
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                            <TableFooter>
                                <TableRow>
                                    <TableCell colspan="3">
                                        Total
                                    </TableCell>
                                    <TableCell class="text-right">
                                        $2,500.00
                                    </TableCell>
                                </TableRow>
                            </TableFooter>
                        </Table>

                    </div>



                    <div class="mt-6 sm:mt-8 lg:flex lg:items-center lg:gap-12">


                    </div>

                </div>
            </div>
        </section>




    </AppLayout>

</template>

<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue'

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
const invoices = [
    {
        invoice: 'INV001',
        paymentStatus: 'Paid',
        totalAmount: '$250.00',
        paymentMethod: 'Credit Card',
    },
    {
        invoice: 'INV002',
        paymentStatus: 'Pending',
        totalAmount: '$150.00',
        paymentMethod: 'PayPal',
    },
    {
        invoice: 'INV003',
        paymentStatus: 'Unpaid',
        totalAmount: '$350.00',
        paymentMethod: 'Bank Transfer',
    },
    {
        invoice: 'INV004',
        paymentStatus: 'Paid',
        totalAmount: '$450.00',
        paymentMethod: 'Credit Card',
    },
    {
        invoice: 'INV005',
        paymentStatus: 'Paid',
        totalAmount: '$550.00',
        paymentMethod: 'PayPal',
    },
    {
        invoice: 'INV006',
        paymentStatus: 'Pending',
        totalAmount: '$200.00',
        paymentMethod: 'Bank Transfer',
    },
    {
        invoice: 'INV007',
        paymentStatus: 'Unpaid',
        totalAmount: '$300.00',
        paymentMethod: 'Credit Card',
    },
]


</script>
