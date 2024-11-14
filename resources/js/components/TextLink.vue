<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    routeName: String,
    label: String
})
</script>

<template>
    <Link
        :href="route(routeName)"
        class="text-purple-700 hover:text-indigo-900 font-medium underline
        dark:text-purple-100 dark:hover:text-purple-400">
        {{ label }}
    </Link>
</template>
