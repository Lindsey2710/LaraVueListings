<script setup>
import Container from '../../components/Container.vue';
import Title from '../../components/Title.vue';
import InputField from '../../components/InputField.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    token: String,
    email: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
}
</script>

<template>
    <Head title=" - Reset Password" />
    <!-- Container and the others get imported after creating it in components -->
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Enter your new Password </Title>

        </div>

        <!-- Errors messages -->
         <ErrorMessages :errors="form.errors" />

        <form @submit.prevent="submit" class="space-y-6">

            <InputField label="Email" icon="envelope" type="email" v-model="form.email" />

            <InputField label="Password" icon="key" type="password" v-model="form.password" />

            <InputField label="Confirm Password" icon="key" type="password" v-model="form.password_confirmation" />

            <PrimaryBtn :disabled="form.processing">Reset Password</PrimaryBtn>
        </form>
    </Container>
</template>
