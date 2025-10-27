<script lang="ts">
import { Table, TableHeader, TableRow, TableHead, TableBody, TableCell } from '@/components/ui/table'

export default {
    name: 'ExcelTable',

    props: {
        data: {
            type: Array,
            required: true,
        },

    },
}
</script>

<template>
    <div class="p-6">
        <h2 class="text-2xl font-semibold mb-4">Lista de Alunos</h2>

        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead>Nome</TableHead>

                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="(aluno, index) in data" :key="index">
                    <TableCell>{{ aluno.project_id }}</TableCell>

                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>
