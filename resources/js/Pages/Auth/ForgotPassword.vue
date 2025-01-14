<script setup>
import Container from '../../components/Container.vue';
import InputField from '../../components/InputField.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';
import SessionMessages from '../../components/SessionMessages.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
});

defineProps({
    status: String
})

const submit = () => {
    form.post(route('password.email'));
}
</script>

<template>
    <Head title=" - Forgot Password" />
    <Container class="w-full md:w-2/3 lg:w-1/2 px-4">
        <div class="mb-8 text-center">
            <p class="break-words">
                Forgot your password? No problem. Just let us know your email address and
                we will email you a password reset link that will allow you to choose a new one.
            </p>
        </div>

        <ErrorMessages :errors="form.errors" />
        <SessionMessages :status="status" />

        <form @submit.prevent="submit" class="space-y-6 max-w-full">
            <InputField label="Email" icon="envelope" type="email" v-model="form.email" />

            <PrimaryBtn :disabled="form.processing">
                Send Password Reset Link
            </PrimaryBtn>
        </form>
    </Container>
</template>



