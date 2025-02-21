<script lang="ts" setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="pb-10 text-center text-4xl font-black text-white">
            Forgot Password?
        </div>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            No problem. Just let us know your email address and we will email
            you a password reset link that will allow you to choose a new one.
        </div>

        <div
            v-if="status"
            class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    v-model="form.email"
                    autocomplete="username"
                    autofocus
                    class="mt-1 block w-full"
                    required
                    type="email"
                />

                <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                class="mt-4 flex w-full justify-center"
            >
                Email Reset Password Link
            </PrimaryButton>

            <Link
                :href="route('login')"
                class="mt-4 inline-block w-full rounded-md text-center text-sm underline ring-1 ring-transparent transition dark:text-gray-400 dark:hover:text-amber-300 dark:focus-visible:ring-white"
            >
                Go back to login
            </Link>
        </form>
    </GuestLayout>
</template>
