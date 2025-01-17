<script setup>
import { Head, router } from '@inertiajs/vue3';
import Title from '../components/Title.vue';
import PaginationLinks from '../components/PaginationLinks.vue';
import SessionMessages from '../components/SessionMessages.vue';

defineProps({
    listings: Object,
    status: String
});

const deleteListing = (id) => {
    if (confirm('Are you sure you want to delete this list item?')) {
        router.delete(route('listing.destroy', id));
    }
}
</script>

<template>

    <Head title=" - Dashboard" />
    <SessionMessages :status="status" />

    <div v-if="listings" class="">
        <div v-if="Object.keys(listings.data).length">
            <div>
                <!-- Heading -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2">
                    <Title>Your latest list items</Title>

                    <div class="flex items-center gap-4 text-xs">
                        <p>Approved <i class="fa-solid fa-circle-check text-green-600"></i></p>
                        <p>Pending approval <i class="fa-solid fa-circle-xmark text-orange-500"></i></p>
                    </div>
                </div>

                <!-- Mobile Cards (visible on small screens) -->
                <div class="sm:hidden space-y-4">
                    <div v-for="listing in listings.data" 
                         :key="listing.id" 
                         class="bg-white dark:bg-indigo-800 p-4 rounded-lg ring-2 ring-indigo-300 dark:ring-indigo-800 shadow-lg">
                        <div class="flex gap-3 mb-4">
                            <img class="w-20 h-auto"
                                :src="listing.image ? `/storage/${listing.image}` : `/storage/images/listing/default.jpg`"
                                alt="">
                            <h4 class="font-bold">
                                {{ listing.title }}
                                <i :class="`fa-solid fa-${listing.approved ? 'circle-check text-green-600' : 'circle-xmark text-orange-500'}`"></i>
                            </h4>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <Link 
                                v-if="listing.approved" 
                                :href="route('listing.show', listing.id)" 
                                class="bg-orange-600 rounded-md text-white px-6 py-2 hover:outline outline-orange-600 outline-offset-2"
                            >
                                View
                            </Link>
                            <Link 
                                :href="route('listing.edit', listing.id)" 
                                class="bg-green-600 rounded-md text-white px-6 py-2 hover:outline outline-green-600 outline-offset-2"
                            >
                                Edit
                            </Link>
                            <button 
                                @click="deleteListing(listing.id)" 
                                type="button" 
                                class="bg-red-600 rounded-md text-white px-6 py-2 hover:outline outline-red-600 outline-offset-2"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Desktop Table (hidden on small screens) -->
                <table class="hidden sm:table w-full table-fixed border-collapse overflow-hidden rounded-lg
                            text-sm ring-2 ring-indigo-300 dark:ring-indigo-800 bg-white shadow-2xl">
                    <thead
                        class="bg-indigo-200 text-xs uppercase dark:bg-indigo-900 text-indigo-950 dark:text-indigo-200">
                        <tr>
                            <th class="w-3/4 p-3 text-left">Title</th>
                            <th class="w-1/4 py-3 pr-3 text-right">View</th>
                            <th class="w-1/5 py-3 pr-3 text-right">Edit</th>
                            <th class="w-1/5 py-3 pr-3 text-right">delete</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="listing in listings.data" :key="listing.id" class="border-b border-indigo-200 hover:bg-indigo-300 dark:bg-indigo-800
                                                        dark:hover:bg-indigo-600 dark:border-indigo-600">

                            <td class="w-3/4 p-3 text-left">
                                <div class="flex items-center gap-2">
                                    <img class="w-20 h-full"
                                        :src="listing.image ? `/storage/${listing.image}` : `/storage/images/listing/default.jpg`"
                                        alt="">

                                    <h4 class="font-bold">
                                        {{ listing.title }}
                                        <i
                                            :class="`fa-solid fa-${listing.approved ? 'circle-check text-green-600' : 'circle-xmark text-orange-500'}`"></i>
                                    </h4>
                                </div>
                            </td>

                            <td class="w-1/4 py-3 pr-3 text-right text-purple-950 dark:text-purple-100">
                                <Link v-if="listing.approved" :href="route('listing.show', listing.id)" class="bg-orange-600 rounded-md text-white
                                px-6 py-2 hover:outline outline-orange-600 outline-offset-2">
                                View
                                </Link>
                            </td>

                            <td class="w-1/5 py-3 pr-3 text-right">
                                <Link :href="route('listing.edit', listing.id)" class="bg-green-600 rounded-md text-white
                                px-6 py-2 hover:outline outline-green-600 outline-offset-2">
                                Edit
                                </Link>
                            </td>

                            <td class="w-1/5 py-3 pr-3 text-right">
                                <button @click="deleteListing(listing.id)" type="button" class="bg-red-600 rounded-md text-white
                                px-6 py-2 hover:outline outline-red-600 outline-offset-2">
                                    Delete
                                </button>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                <PaginationLinks :paginator="listings" />
            </div>

        </div>
        <div v-else class="text-center py-8">
            You have no list items yet! Start creating some now.
        </div>

    </div>
    <div v-else class="text-center py-8">
        Due to violation of our terms and conditions, your account has been suspended.
        Please contact us for more information at
        <a class="text-link" href="mailto:lindseyverbauwhede@linkatver.com">info@linkatver.com</a>.
    </div>
</template>
