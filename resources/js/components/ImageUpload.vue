<script setup>
import { ref } from 'vue';

const emit = defineEmits(['image']);

const props = defineProps({
    listingImage: String
});

const currentImage = props.listingImage ? `/storage/${props.listingImage}` : null;

const preview = ref(currentImage);
const oversizedImage = ref(false);
const showRevertBtn = ref(false);

const imageSelected = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0]);
    oversizedImage.value = e.target.files[0].size > 5000000;
    showRevertBtn.value = true;
    emit('image', e.target.files[0]);
};

const revertImageChange = () => {
    showRevertBtn.value = false;
    preview.value = currentImage;
    oversizedImage.value = false;
    emit('image', null);
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
           class="block rounded-md mt-1 bg-white h-[140px] overflow:hidden cursor-pointer border-indigo-400 border relative"
           :class="{'!border-red-500' : oversizedImage}">
           <img :src="preview ?? '/storage/images/listing/default.jpg'"
            class="w-full h-full object-cover object-center"
            alt="">

                <button
                    class="absolute top-2 right-2 bg-white/75 w-8 h-8 rounded-full grid place-items-center
                    text-slate-800"
                    v-if="showRevertBtn"
                    type="button"
                    @click.prevent="revertImageChange">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>

        </label>

        <input @input="imageSelected" type="file" name="image" id="image" hidden>
    </div>
</template>

