<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';

const props = defineProps({
    listing: Object,
    user: Object,

});

const deleteListing = () => {
    if  (confirm('Are you sure you want to delete this list item?')) {
        router.delete(route('listing.destroy', props.listing.id));
    }
};

const toggleApprove = () => {
    let msg = props.listing.approved
        ? "Disapprove this listing?"
        : "Approve this listing?";

    if (confirm(msg)) {
        router.put(route("admin.approve", props.listing.id));
    }
};
</script>

<template>
    <Head title=" - item details" />

    <!-- Admin -->
    <div v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'"
        class="bg-indigo-950 text-white mb-6 p-4 md:p-6 rounded-md flex flex-col md:flex-row items-center gap-4 md:justify-between">
        <p class="font-bold text-center md:text-left">This list item is {{ listing.approved ? 'Approved' : 'Disapproved' }}</p>
        <button @click.prevent="toggleApprove" class="bg-indigo-400 px-3 py-1 rounded-md w-full md:w-auto">
            {{ listing.approved ? 'Disapprove it' : 'Approve it' }}
        </button>
    </div>

    <Container class="flex flex-col md:flex-row gap-4 px-4">
        <!-- Image container -->
        <div class="w-full md:w-1/4 rounded-md overflow-hidden">
            <img :src="listing.image
                ? `/storage/${listing.image}`
                : '/storage/images/listing/default.jpg'" 
                class="w-full h-48 md:h-full object-cover object-center" alt="">
        </div>

        <!-- Content container -->
        <div class="w-full md:w-3/4">
            <!-- List item info -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row items-center justify-between mb-2">
                    <p class="text-indigo-950 dark:text-indigo-100 w-full border-b">List item details</p>

                    <!-- Edit and delete buttons -->
                    <div v-if="canModify" class="pt-4 md:pt-0 md:pl-4 flex items-center gap-4 w-full md:w-auto">
                        <Link
                            :href="route('listing.edit', listing.id)"
                            class="flex-1 md:flex-none text-center bg-green-600 rounded-md text-white px-6 py-2 hover:outline outline-green-600 outline-offset-2"
                        >
                            Edit
                        </Link>

                        <button
                            @click="deleteListing"
                            type="button"
                            class="flex-1 md:flex-none bg-red-600 rounded-md text-white px-6 py-2 hover:outline outline-red-600 outline-offset-2"
                        >
                            Delete
                        </button>
                    </div>
                </div>

                <h3 class="font-bold text-xl md:text-2xl mb-4 break-words">{{ listing.title }}</h3>
                <p class="break-words">{{ listing.desc }}</p>
            </div>

            <!-- User info -->
            <div class="mb-6">
                <p class="text-indigo-950 dark:text-indigo-100 w-full border-b mb-2">General info</p>

                <!-- Email -->
                <div v-if="listing.email" class="flex flex-col sm:flex-row items-start sm:items-center mb-2 gap-1 sm:gap-2 break-all">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope min-w-[1rem]"></i>
                        <p>Email:</p>
                    </div>
                    <a :href="`mailto:${listing.email}`" class="text-link ml-6 sm:ml-0">{{ listing.email }}</a>
                </div>

                <!-- Link -->
                <div v-if="listing.link" class="flex flex-col sm:flex-row items-start sm:items-center mb-2 gap-1 sm:gap-2 break-all">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-globe min-w-[1rem]"></i>
                        <p>Link:</p>
                    </div>
                    <a :href="listing.link" target="_blank" class="text-link ml-6 sm:ml-0">{{ listing.link }}</a>
                </div>

                <!-- User -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center mb-2 gap-1 sm:gap-2">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-user-check min-w-[1rem]"></i>
                        <p>Listed by:</p>
                    </div>
                    <Link :href="route('home', { user_id: user.id })" class="text-link ml-6 sm:ml-0">{{ user.name }}</Link>
                </div>
            </div>

            <!-- Tags -->
            <div v-if="listing.tags" class="mb-6">
                <p class="text-indigo-950 dark:text-indigo-100 w-full border-b mb-2">Tags</p>
                <div class="flex flex-wrap items-center gap-3">
                    <div v-for="tag in listing.tags.split(',')" :key="tag">
                        <Link
                            :href="route('home', { tag })"
                            class="bg-slate-500 text-sm text-white px-2 py-px rounded-full hover:bg-slate-700 dark:hover:bg-slate-900">
                            {{ tag }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </Container>
</template>
