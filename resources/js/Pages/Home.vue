<script lang="ts" setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome" />

    <div
        class="flex min-h-screen flex-col items-center justify-center bg-gray-100 text-black/80 dark:bg-slate-900 dark:text-white/80"
    >
        <!-- Logo Section -->
        <div class="mb-8 flex flex-col items-center space-x-4 text-amber-500">
            <!-- Replace the src below with your own logo file or public URL -->
            <img
                alt="Logo"
                class="h-96 w-96 object-contain"
                src="/images/logo.png"
            />
            <h1 class="text-5xl font-bold">Chat AI</h1>
        </div>

        <!-- Short Description -->
        <p class="max-w-md text-center leading-relaxed">
            This AI chatbot helps you with everything from quick answers to more
            in-depth tasks—24/7, at your service.
        </p>

        <PrimaryButton class="mt-8">
            <Link :href="route('login')"> Get Started</Link>
        </PrimaryButton>
    </div>
</template>
