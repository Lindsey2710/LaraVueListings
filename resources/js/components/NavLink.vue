<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    routeName: String,
    componentName: String,
})
</script>

<template>
    <Link :href="route(routeName)" class="px-3 py-2 rounded-lg hover:bg-indigo-950 hover:outline outline-indigo-800 outline-offset-2"
        :class="{ 'bg-indigo-950': $page.component === componentName }">
    <slot />
    </Link>
</template>
