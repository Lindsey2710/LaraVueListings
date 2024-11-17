<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import PaginationLinks from '../../components/PaginationLinks.vue';
import RoleSelect from '../../components/RoleSelect.vue';
import SessionMessages from '../../components/SessionMessages.vue';
import InputField from '../../components/InputField.vue';

defineProps({
    users: Object,
    status: String
});

const params = route().params;

const form = useForm({
    search: params.search,
});

const search = () => {
    router.get(route('admin.index'), {
        search: form.search,
        user_role: params.user_role,
    });
};


const toggleRole = (e) => {
    if (e.target.checked) {
        router.get(
            route("admin.index", {
                search: params.search,
                user_role: "suspended",
            })
        );
    } else {
        router.get(
            route("admin.index", {
                search: params.search,
                user_role: null,
            })
        );
    }
};

</script>

<template>
    <Head title=" - Admin" />

    <SessionMessages :status="status" />
    <!-- Heading -->
    <div class="flex items-end justify-between mb-4">
        <div class="flex items-end gap-2">
        <!-- Search form -->
            <form @submit.prevent="search">
            <InputField
                label=""
                icon="magnifying-glass"
                placeholder="Search ..."
                v-model="form.search"
             />

            </form>
            <Link
                class="px-2 py-[6px] rounded-lg bg-indigo-600 text-white flex items-center gap-2 hover:bg-indigo-950"
                v-if="params.search"
                :href="route('admin.index',
                { ...params, search: null, page: null })"
                >
                {{ params.search }}
                <i class="fa-solid fa-xmark"></i>
            </Link>
        </div>

        <!-- Toggle role btn -->
        <div class="flex items-center gap-1 text-xs hover:bg-indigo-200 dark:hover:bg-indigo-400 px-2 py-1 rounded-md">
            <input
            @input="toggleRole"
                :checked="params.user_role"
                type="checkbox"
                id="toggleRole"
                class="rounded-md border-1 outline-0 text-indigo-500 ring-indigo-600 border-indigo-800
                cursor-pointer">
            <label for="toggleRole" class="block text-sm font-medium text-indigo-950 dark:text-indigo-200 cursor-pointer">
                Show suspended users

            </label>
        </div>
    </div>

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
                <RoleSelect :user="user" />
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
               <!--  <Link
                        :href="route('user.show', user.id)"
                        class="fa-solid fa-up-right-from-square px-3 text-indigo-400"
                    ></Link> -->
            </td>
        </tr>
    </tbody>
    </table>

    <div class="mt-6">
        <PaginationLinks :paginator="users" />
    </div>
</template>

