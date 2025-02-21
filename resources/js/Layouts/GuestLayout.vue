<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900"
    >
        <Link
            :href="route('index')"
            class="flex flex-col items-center text-amber-500"
        >
            <!-- Replace the src below with your own logo file or public URL -->
            <img
                alt="Logo"
                class="h-40 w-40 object-contain"
                src="/images/logo.png"
            />
            <h1 class="text-5xl font-bold">Chat AI</h1>
        </Link>
        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800"
        >
            <slot />
        </div>
    </div>
</template>
