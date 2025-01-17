<script setup>
import Container from '../../components/Container.vue';
import Title from '../../components/Title.vue';
import Inputfield from '../../components/InputField.vue';
import TextArea from '../../components/TextArea.vue';
import ImageUpload from '../../components/ImageUpload.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import { Head, useForm } from '@inertiajs/vue3';


const form = useForm({
    title: null,
    desc: null,
    tags: null,
    email: null,
    link: null,
    image: null,
})
</script>

<template>
    <Head title=" - Create Listing Item" />
    <Container>
        <div class="mb-6">
            <Title>Create List Item</Title>
        </div>

        <ErrorMessages :errors="form.errors" />

        <form @submit.prevent="form.post(route('listing.store'))" class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                <TextArea
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
                    label="External Link"
                    icon="globe"
                    placeholder="https://www.mywebsite.com"
                    v-model="form.link"
                     />

                <ImageUpload @image="(e) => (form.image = e)" />
            </div>

            <div class="md:col-span-2">
                <PrimaryBtn :disabled="form.processing" class="w-full md:w-auto">Create</PrimaryBtn>
            </div>
        </form>
    </Container>
</template>



