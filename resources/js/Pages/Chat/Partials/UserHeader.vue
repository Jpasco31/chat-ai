<script lang="ts" setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

defineProps<{
    userName: string;
    route: Function;
}>();
</script>
<template>
    <div class="flex justify-end p-4">
        <Dropdown align="right" width="48">
            <template #trigger>
                <span class="inline-flex rounded-md">
                    <button
                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                        type="button"
                    >
                        Hello, {{ userName }}!

                        <svg
                            class="-me-0.5 ms-2 h-4 w-4"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                clip-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                fill-rule="evenodd"
                            />
                        </svg>
                    </button>
                </span>
            </template>

            <template #content>
                <DropdownLink
                    as="button"
                    @click.prevent="$emit('openProfileModal')"
                >
                    Profile
                </DropdownLink>
                <DropdownLink :href="route('logout')" as="button" method="post">
                    Log Out
                </DropdownLink>
            </template>
        </Dropdown>
    </div>
</template>
