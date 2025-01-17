<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import Card from '../components/Card.vue';
import PaginationLinks from '../components/PaginationLinks.vue';
import InputField from '../components/InputField.vue';

const params= route().params;

const props = defineProps({
    listings: Object,
    searchTerm: String,
});

 const username = params.user_id ? props.listings.data.find(i =>
i.user_id === Number(params.user_id)).user.name : null;


const form = useForm({
    search: props.searchTerm,
});

const search = () => {
    router.get(route('home'), { search: form.search, user_id: params.user_id, tag: params.tag });
};
</script>

<template>

    <Head title=" - Latest Listings" />

    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-4">
        <div class="flex flex-wrap items-center gap-2">
            <Link
                class="px-2 py-1 rounded-lg bg-indigo-600 text-white flex items-center gap-2 hover:bg-indigo-950 text-sm"
                v-if="params.tag"
                :href="route('home', { ...params, tag: null, page: null })"
            >
                {{ params.tag }}
                <i class="fa-solid fa-xmark"></i>
            </Link>

            <Link
                class="px-2 py-1 rounded-lg bg-indigo-600 text-white flex items-center gap-2 hover:bg-indigo-950 text-sm"
                v-if="params.search"
                :href="route('home', { ...params, search: null, page: null })"
            >
                {{ params.search }}
                <i class="fa-solid fa-xmark"></i>
            </Link>

            <Link
                class="px-2 py-1 rounded-lg bg-indigo-600 text-white flex items-center gap-2 hover:bg-indigo-950 text-sm"
                v-if="params.user_id"
                :href="route('home', { ...params, user_id: null, page: null })"
            >
                {{ username }}
                <i class="fa-solid fa-xmark"></i>
            </Link>
        </div>

        <div class="w-full sm:w-1/4">
            <form @submit.prevent="search">
                <InputField 
                    type="search" 
                    label="" 
                    icon="search" 
                    placeholder="Search..." 
                    v-model="form.search"
                    class="w-full" 
                />
            </form>
        </div>
    </div>

    <div v-if="Object.keys(listings).length">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div v-for="listing in listings.data" :key="listing.id">
                <Card :listing="listing" />
            </div>
        </div>

        <div class="mt-8">
            <PaginationLinks :paginator="listings" />
        </div>
    </div>

    <div v-else class="text-center py-8">
        No Listings Yet
    </div>
</template>
