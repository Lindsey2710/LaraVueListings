<script setup>
import { ref } from 'vue';

const emit = defineEmits(['image']);

const preview = ref(null);
const oversizedImage = ref(false);

const imageSelected = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0]);
    oversizedImage.value = e.target.files[0].size > 5000000;
    emit('image', e.target.files[0]);
};
</script>

<template>
    <div>
        <span
            class="block text-sm font-medium text-slate-700 dark:text-white"
            :class="{'!text-red-500' : oversizedImage}">
            {{ oversizedImage ? 'Image too large' : 'Image (Max size 5Mb)' }}
        </span>

        <label
           for="image"
           class="block rounded-md mt-1 bg-white h-[140px] overflow:hidden cursor-pointer border-indigo-400 border"
           :class="{'!border-red-500' : oversizedImage}">
           <img :src="preview ?? '/storage/images/listing/default.jpg'"
            class="w-full h-full object-cover object-center"
            alt="">
        </label>

        <input @input="imageSelected" type="file" name="image" id="image" hidden>
    </div>
</template>

