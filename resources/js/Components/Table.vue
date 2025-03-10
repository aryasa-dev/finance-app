<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    headers: {
        type: Array,
        required: true,
    },
    rows: {
        type: Array,
        required: true,
    },
    routeKey: {
        type: String,
    },
});

</script>

<template>
    <div>
        <table
            class="table-auto border-collapse border border-gray-300 w-full text-gray-800 dark:text-gray-100"
        >
            <thead>
                <tr>
                    <th
                        v-for="(header, index) in headers"
                        :key="index"
                        class="border border-gray-300 py-2"
                    >
                        {{ header }}
                    </th>
                    <th class="border border-gray-300 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, index) in rows" :key="index">
                    <td
                        v-for="(value, colIndex) in Object.values(row)"
                        :key="colIndex"
                        class="border p-2"
                    >
                        {{ value }}
                    </td>
                    <td class="border p-2">
                        <div class="flex items-center gap-x-3">
                            <Link
                                :href="`${routeKey}/edit/${row.id}`"
                                class="font-semibold text-blue-500"
                                >Edit</Link
                            >
                            <button
                                @click="$emit('delete', row.id)"
                                class="font-semibold text-red-500"
                            >
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
