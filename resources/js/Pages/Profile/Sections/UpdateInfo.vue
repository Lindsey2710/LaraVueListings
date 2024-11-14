<script setup>
import Container from '../../../components/Container.vue';
import Title from '../../../components/Title.vue';
import InputField from '../../../components/InputField.vue';
import PrimaryBtn from '../../../components/PrimaryBtn.vue';
import ErrorMessages from '../../../components/ErrorMessages.vue';
import SessionMessages from '../../../components/SessionMessages.vue';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    status: String
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
});

const resendEmail = (e) => {
    router.post(route('verification.send'), {}, {
        onStart: () => (e.target.disabled = true),
        onFinish: () => (e.target.disabled = false),
    });
};
</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
           <Title>Update Info</Title>
           <p>Update your account's profile information and email address.</p>
        </div>

        <ErrorMessages :errors="form.errors" />

        <form class="space-y-6" @submit.prevent="form.patch(route('profile.info'))">
            <InputField label="Name" icon="id-badge" class="w-1/2" v-model="form.name" />

            <InputField label="Email" icon="envelope" class="w-1/2" v-model="form.email" />

            <div v-if="user.email_verified_at === null">
                <SessionMessages :status="status" />
                <p>
                    Your email address is unverified.
                    <button
                        @click="resendEmail"
                        class="text-purple-700 font-medium underline
                        dark:text-purple-100 disabled:cursor-wait">
                        Click here to resend the verification email.
                    </button>

                </p>

            </div>

            <PrimaryBtn :disabled="form.processing">Save</PrimaryBtn>
        </form>
    </Container>
</template>
