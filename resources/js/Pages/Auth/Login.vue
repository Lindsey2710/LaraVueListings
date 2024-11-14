<script setup>
import Container from '../../components/Container.vue';
import Title from '../../components/Title.vue';
import TextLink from '../../components/TextLink.vue';
import InputField from '../../components/InputField.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import ErrorMessages from '../../components/ErrorMessages.vue';
import SessionMessages from '../../components/SessionMessages.vue';
import Checkbox from '../../components/Checkbox.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: null,
});

defineProps({
    status: String
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
}
</script>

<template>
    <Head title=" - Login" />
    <!-- Container and the others get imported after creating it in components -->
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Login to your account </Title>
            <p>
                Need an account?
                <TextLink routeName="register" label="Register" />
            </p>
        </div>

        <!-- Errors messages -->
         <ErrorMessages :errors="form.errors" />
         <SessionMessages :status="status" />

        <form @submit.prevent="submit" class="space-y-6">

            <InputField label="Email" icon="envelope" type="email" v-model="form.email" />

            <InputField label="Password" icon="key" type="password" v-model="form.password" />

            <div class="flex items-center justify-between">

                <Checkbox name="remember" v-model="form.remember">Remember me</Checkbox>

                <TextLink routeName="password.request" label="Forgot Password?" />
            </div>

            <PrimaryBtn :disabled="form.processing">Login</PrimaryBtn>
        </form>
    </Container>
</template>



