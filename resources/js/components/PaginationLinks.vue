<script setup>
defineProps({
    paginator: Object
});

const makeLabel = (label) => {
    if (label.includes('Previous')) {
        return "<<";
    } else if (label.includes('Next')) {
        return ">>";
    } else {
        return label;
    }
};
</script>

<template>
    <div class="flex justify-between items-start">
        <div class="flex items-center rounded-md overflow-hidden shadow-2xl">
            <div v-for="(link, i) in paginator.links" :key="i" class="">

                <component
                    :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    v-html="makeLabel(link.label)"
                    class="border-x border-indigo-400 w-12 h-12 grid
                    place-items-center bg-indigo-200 dark:bg-indigo-950 dark:border-indigo-800"
                    :class="{'hover:bg-indigo-400 dark:hover:bg-indigo-700':
                    link.url,
                        'text-indigo-400' : !link.url,
                        'font-bold bg-indigo-400 dark:bg-indigo-700' : link.active
                    }" />

            </div>
        </div>

        <p class="text-indigo-950 dark:text-indigo-200 text-sm">
            Showing {{ paginator.from }} to {{ paginator.to }} of {{ paginator.total }} results
        </p>
    </div>
</template>

