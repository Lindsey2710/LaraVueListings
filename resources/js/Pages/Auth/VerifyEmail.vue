<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Container from '../../components/Container.vue';
import PrimaryBtn from '../../components/PrimaryBtn.vue';
import SessionMessages from '../../components/SessionMessages.vue';


const form = useForm({});

defineProps({
    status: String,
});

const submit = () => {
    form.post(route("verification.send"))
};
</script>

<template>
    <Head title=" - Email Verification" />

    <Container class="w-1/2 ">
        <div class="mb-8">
            <p>
                Thanks for signing up! Before getting started, could you verify
                your email address by clicking on the link we just emailed you?
                If you didn't receive the email, we will gladly send you a new one.
            </p>
        </div>

        <SessionMessages :status="status" />

        <form @submit.prevent="submit">
            <PrimaryBtn :disabled="form.processing">Resend Verification Email</PrimaryBtn>
        </form>
    </Container>

</template>
