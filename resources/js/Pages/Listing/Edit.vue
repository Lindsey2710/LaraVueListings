<script setup>
import Container from '../../components/Container.vue';
import Title from '../../components/Title.vue';
import Inputfield from '../../components/InputField.vue';
import Textarea from '../../components/Textarea.vue';
import ImageUpload from '../../components/ImageUpload.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    listing: Object
});


const form = useForm({
    title: props.listing.title,
    desc: props.listing.desc,
    tags: props.listing.tags,
    email: props.listing.email,
    link: props.listing.link,
    image: null,
    _method: 'PUT'
})
</script>

<template>
    <Head title=" - Edit Listing Item" />
    <Container>
        <div class="mb-6">
            <Title>Edit Your List Item</Title>
        </div>

        <ErrorMessages :errors="form.errors" />

        <form @submit.prevent="form.post(route('listing.update', listing.id))" class="grid grid-cols-2 gap-6">
            <div class="space-y-6">
                <Inputfield
                    label="Title"
                    icon="heading"
                    placeholder="My New Listing"
                    v-model="form.title"
                     />

                <Inputfield
                    label="Tags (separated by commas)"
                    icon="tags"
                    placeholder="books, movies, websites"
                    v-model="form.tags"
                     />
                <Textarea
                    label="Description"
                    icon="file-lines"
                    placeholder="This Is The Description"
                    v-model="form.desc"
                     />
            </div>

            <div class="space-y-6">
                <Inputfield
                    label="Email"
                    icon="envelope"
                    placeholder="example@email.com"
                    v-model="form.email"
                     />

                <Inputfield
                    label="ExternalLink"
                    icon="globe"
                    placeholder="https://www.mywebsite.com"
                    v-model="form.link"
                     />

                <ImageUpload @image="(e) => (form.image = e)"
                    :listingImage="listing.image" />
            </div>

            <div>
                <PrimaryBtn :disabled="form.processing">Update</PrimaryBtn>
            </div>
        </form>
    </Container>
</template>



