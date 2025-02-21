<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';

defineProps<{
    href?: string; // href might be undefined
    method?: string; // allow a method for Inertia
    as?: string; // let the user specify "button" if they want
}>();
</script>

<template>
    <component
        :is="href ? Link : 'button'"
        :as="as"
        :href="href"
        :method="method"
        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800"
    >
        <slot />
    </component>
</template>
