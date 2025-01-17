<script setup>
import Container from '../../../components/Container.vue';
import Title from '../../../components/Title.vue';
import InputField from '../../../components/InputField.vue';
import PrimaryBtn from '../../../components/PrimaryBtn.vue';
import ErrorMessages from '../../../components/ErrorMessages.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.put(route('profile.password'), {
        /** after incorrect input, form will be reset */
        onSuccess: () => form.reset(),
        onError: () => form.reset(),
        /* prevents the page to jump up to the top but stay on the section you are working on */
        preserveScroll: true,
    });
}

</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
           <Title>Update Password</Title>
           <p>Update your password with a secure one</p>
        </div>

        <ErrorMessages :errors="form.errors" />

        <form class="space-y-6" @submit.prevent="submit">
            <InputField 
                label="Current Password" 
                icon="key" 
                type="password" 
                class="w-full md:w-1/2" 
                v-model="form.current_password" 
            />

            <InputField 
                label="New Password" 
                icon="key" 
                type="password" 
                class="w-full md:w-1/2" 
                v-model="form.password" 
            />

            <InputField 
                label="Confirm Password" 
                icon="key" 
                type="password" 
                class="w-full md:w-1/2" 
                v-model="form.password_confirmation" 
            />

            <p 
                v-if="form.recentlySuccessful" 
                class="text-green-600 font-medium text-sm sm:text-base"
            >
                Saved!
            </p>

            <PrimaryBtn 
                :disabled="form.processing"
                class="w-full md:w-auto"
            >
                Save
            </PrimaryBtn>
        </form>
    </Container>
</template>
