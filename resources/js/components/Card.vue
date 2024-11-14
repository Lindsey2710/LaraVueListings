<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    listing: Object,
})
</script>

<template>
    <div class="bg-indigo-200 rounded-lg shadow-2xl overflow-hidden
    dark:bg-indigo-900 h-full flex flex-col justify-between">

    <div>
        <!-- Image goes here -->
         <Link href="">
            <img
                :src="listing.image
                ? `/storage/${listing.image}`
                : '/storage/images/listing/default.jpg'"
                alt="image"
                class="w-full h-48 bg-gradient-to-r from-indigo-600 to-cyan-400 object-cover object-center">
         </Link>

         <!-- Title, Date & User -->
         <div class="p-4">
             <h3 class="text-xl font-bold text-indigo-950 dark:text-indigo-200">
                {{ listing.title.substring(0, 40) }}...
            </h3>
             <p class="text-sm text-indigo-950 dark:text-indigo-200">Listed on {{ new Date(listing.created_at).
                 toLocaleDateString() }} by
                <button class="text-link">
                    {{ listing.user.name }}
                </button>
             </p>
         </div>
    </div>

    <!-- Tags -->
     <div v-if="listing.tags" class="flex items-center gap-3 px-4 pb-4">
        <div v-for="tag in listing.tags.split(',')" :key="tag">
            <button class="bg-slate-500 text-sm text-white
                            px-2 py-px rounded-full hover:bg-slate-700 dark:hover:bg-slate-800">
                {{ tag }}
            </button>

        </div>
     </div>
    </div>
</template>


