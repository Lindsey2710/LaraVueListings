<script setup>
import { Head } from '@inertiajs/vue3';
import PaginationLinks from '../../components/PaginationLinks.vue';

defineProps({
    users: Object
})

</script>

<template>
    <Head title=" - Admin" />

    <!-- Heading -->
    <div>Heading</div>

    <!-- Table -->
    <table class="w-full table-fixed border-collapse overflow-hidden rounded-lg
            text-sm ring-2 ring-indigo-300 dark:ring-indigo-800 bg-white shadow-2xl">
    <thead>
        <tr class="bg-indigo-200 text-xs uppercase text-left dark:bg-indigo-900 text-indigo-950 dark:text-indigo-200">
            <th class="w-3/6 p-3">Name</th>
            <th class="w-2/6 p-3">Role</th>
            <th class="w-1/6 p-3">Listings</th>
            <th class="w-1/6 p-3 text-right">View</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-white bg-indigo-400 divide-dashed">
        <tr
            v-for="user in users.data"
            :key="user.id"
            class="border-b border-indigo-200 bg-white dark:bg-indigo-500 dark:border-indigo-600">
            <td class="w-3/6 px-3">
                <p class="font-bold mb-1">{{ user.name }}</p>
                <p class="font-light text-xs">{{ user.email }}</p>
            </td>

            <td class="w-2/6 py-5 px-3">
                {{ user.role }}
            </td>

            <td class="w-1/6 py-5 px-3">
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-1">
                    <!-- Check in the db fore approved listings count -->
                        <p>{{ user.listings.filter(l => l.approved).length }}</p>
                        <i class="fa-solid fa-circle-check text-green-600"></i>
                    </div>
                    <div class="flex items-center gap-1">
                        <p>{{ user.listings.filter(l => !l.approved).length }}</p>
                        <i class="fa-solid fa-circle-xmark text-orange-600"></i>
                    </div>
                </div>
            </td>

            <td class="w-1/6 py-5 px-3 text-right">
                View link
            </td>
        </tr>
    </tbody>
    </table>

    <div class="mt-6">
        <PaginationLinks :paginator="users" />
    </div>
</template>

