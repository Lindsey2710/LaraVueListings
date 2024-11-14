<script setup>
const model = defineModel();

defineProps({
    name: String,
});

</script>

<template>
    <div class="flex items-center gap-2">
        <input type="checkbox" v-model="model" :id="name"
            class="rounded-md border-1 outline-0 text-slate-500 ring-slate-500 border-indigo-700" />
        <label :for="name" class="block text-sm font-medium text-indigo-700 dark:text-indigo-200 cursor-pointer">
            <slot />
        </label>
    </div>
</template>
