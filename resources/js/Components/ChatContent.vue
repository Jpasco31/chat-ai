<script lang="ts" setup>
import { Context } from '@/types/message';
import { computed } from 'vue';

const props = defineProps<{
    context: Context;
    loading?: boolean;
}>();

// Check if role is 'user' for alignment/style
const isUser = computed(() => props.context.role === 'user');
</script>

<template>
    <!-- Outer flex container for alignment -->
    <div class="mb-4 flex w-full">
        <!-- Bubble container -->
        <div
            :class="[
                isUser
                    ? 'ml-auto bg-slate-800 font-bold'
                    : 'mr-auto bg-slate-700',
                'flex max-w-[80%] items-center rounded-lg px-4 py-6 text-white',
            ]"
        >
            <!-- Assistant icon on left for non-user -->
            <span v-if="!isUser" class="mr-4">
                <svg
                    class="size-8 text-amber-500"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </span>

            <!-- Chat content or typing dots -->
            <section class="w-full pl-2 pr-6">
                <!-- If loading, show dot-typing; else show the actual message text -->
                <div v-if="!isUser && props.loading" class="dot-typing"></div>
                <p v-else class="whitespace-pre-wrap text-justify text-sm">
                    {{ props.context.content }}
                </p>
            </section>

            <!-- User icon on right for user messages -->
            <span v-if="isUser" class="ml-4">
                <svg
                    class="size-8 text-indigo-400"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </span>
        </div>
    </div>
</template>

<style scoped>
.dot-typing {
    position: relative;
    left: -9999px;
    width: 10px;
    height: 10px;
    border-radius: 5px;
    background-color: #f9a81c;
    color: #f9a81c;
    box-shadow:
        9984px 0 0 0 #f9a81c,
        9999px 0 0 0 #f9a81c,
        10014px 0 0 0 #f9a81c;
    animation: dot-typing 1.5s infinite linear;
}

@keyframes dot-typing {
    0% {
        box-shadow:
            9984px 0 0 0 #f9a81c,
            9999px 0 0 0 #f9a81c,
            10014px 0 0 0 #f9a81c;
    }
    16.667% {
        box-shadow:
            9984px -10px 0 0 #f9a81c,
            9999px 0 0 0 #f9a81c,
            10014px 0 0 0 #f9a81c;
    }
    33.333% {
        box-shadow:
            9984px 0 0 0 #f9a81c,
            9999px 0 0 0 #f9a81c,
            10014px 0 0 0 #f9a81c;
    }
    50% {
        box-shadow:
            9984px 0 0 0 #f9a81c,
            9999px -10px 0 0 #f9a81c,
            10014px 0 0 0 #f9a81c;
    }
    66.667% {
        box-shadow:
            9984px 0 0 0 #f9a81c,
            9999px 0 0 0 #f9a81c,
            10014px 0 0 0 #f9a81c;
    }
    83.333% {
        box-shadow:
            9984px 0 0 0 #f9a81c,
            9999px 0 0 0 #f9a81c,
            10014px -10px 0 0 #f9a81c;
    }
    100% {
        box-shadow:
            9984px 0 0 0 #f9a81c,
            9999px 0 0 0 #f9a81c,
            10014px 0 0 0 #f9a81c;
    }
}
</style>
