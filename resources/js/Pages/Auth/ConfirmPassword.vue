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
    password: '',
});


const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
}
</script>

<template>
    <Head title=" - Password Confirmation" />
    <!-- Container and the others get imported after creating it in components -->
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <p>
                This is a secure area of the application.
                Please confirm your password before continuing
            </p>
        </div>

         <ErrorMessages :errors="form.errors" />

        <form @submit.prevent="submit" class="space-y-6">

            <InputField label="Password" icon="key" type="password" v-model="form.password" />

            <PrimaryBtn :disabled="form.processing">Confirm</PrimaryBtn>
        </form>
    </Container>
</template>



