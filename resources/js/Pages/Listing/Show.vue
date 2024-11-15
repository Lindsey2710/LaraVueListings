<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';

const props = defineProps({
    listing: Object,
    user: Object,
    canModify: Boolean
});

const deleteListing = () => {
    if  (confirm('Are you sure you want to delete this list item?')) {
        router.delete(route('listing.destroy', props.listing.id));
    }
}
</script>

<template>

    <Head title=" - item details" />
    <Container class="flex gap-4">
        <div class="w-1/4 rounded-md overflow-hidden">
            <img :src="listing.image
                ? `/storage/${listing.image}`
                : '/storage/images/listing/default.jpg'" class="w-full h-48 object-cover object-center" alt="">
        </div>

        <div class="w-3/4">
            <!-- List item info -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-indigo-950 dark:text-indigo-100 w-full border-b">List item details</p>

                    <!-- Edit and delete buttons -->
                    <div v-if="canModify" class="pl-4 flex items-center gap-4">
                    <Link
                        :href="route('listing.edit', listing.id)"
                        class="bg-green-600 rounded-md text-white
                                px-6 py-2 hover:outline outline-green-600 outline-offset-2">
                        Edit
                    </Link>

                    <button
                        @click="deleteListing"
                        type="button"
                        class="bg-red-600 rounded-md text-white
                    px-6 py-2 hover:outline outline-red-600 outline-offset-2">
                        Delete
                    </button>
                    </div>
                </div>

                <h3 class="font-bold text-2xl mb-4">{{ listing.title }}</h3>
                <p>{{ listing.desc }}</p>
            </div>

            <!-- User info -->
            <div class="mb-6">
                    <p class="text-indigo-950 dark:text-indigo-100 w-full border-b mb-2">General info</p>

                    <!-- Email -->
                    <div v-if="listing.email" class="flex items-center mb-2 gap-2">
                        <i class="fa-solid fa-envelope"></i>
                        <p>Email: </p>
                        <a :href="`mailto:${listing.email}`"
                            class="text-link">{{ listing.email }}
                        </a>
                    </div>

                    <!-- Link -->
                    <div v-if="listing.link" class="flex items-center mb-2 gap-2">
                        <i class="fa-solid fa-globe"></i>
                        <p>Link: </p>
                        <a :href="listing.link"
                            target="_blank"
                            class="text-link">{{ listing.link }}
                        </a>
                    </div>

                    <!-- User -->
                    <div  class="flex items-center mb-2 gap-2">
                        <i class="fa-solid fa-user-check"></i>
                        <p>Listed by: </p>
                        <Link :href="route('home', { user_id: user.id })" class="text-link">{{ user.name }}</Link>
                    </div>
            </div>

                <!-- Tags -->
            <div v-if="listing.tags" class="mb-6">
                <p class="text-indigo-950 dark:text-indigo-100 w-full border-b mb-2">Tags</p>
                <div class="flex items-center gap-3">
                <div v-for="tag in listing.tags.split(',')"
                     :key="tag">
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
