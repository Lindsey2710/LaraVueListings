<script setup>
import Container from '../../components/Container.vue';
import Title from '../../components/Title.vue';
import TextLink from '../../components/TextLink.vue';
import InputField from '../../components/InputField.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
}
</script>

<template>
    <Head title=" - Register" />
    <!-- Container and the others get imported after creating it in components -->
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Register here for an account </Title>
            <p>
                Already have an account?
                <TextLink routeName="login" label="Login" />
            </p>
        </div>

        <!-- Errors messages -->
         <ErrorMessages :errors="form.errors" />

        <form @submit.prevent="submit" class="space-y-6">
            <InputField label="Name" icon="id-card" v-model="form.name" />

            <InputField label="Email" icon="envelope" type="email" v-model="form.email" />

            <InputField label="Password" icon="key" type="password" v-model="form.password" />

            <InputField label="Confirm Password" icon="key" type="password" v-model="form.password_confirmation" />

            <p class="text-indigo-900 text-xs dark:text-indigo-100">
                By creating an account, you agree to our Terms of Service and Privacy Policy.
            </p>

            <PrimaryBtn :disabled="form.processing">Register</PrimaryBtn>
        </form>
    </Container>
</template>
