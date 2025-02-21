<!-- ChatListItem.vue -->
<script lang="ts" setup>
import { Chat, Message } from '@/types/message';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

defineProps<{
    message: Message;
    chat: Chat | null;
}>();
</script>

<template>
    <li class="group my-2 flex justify-between">
        <Link
            :class="[
                message.id === chat?.id
                    ? 'bg-slate-700 text-amber-500'
                    : 'bg-slate-900 text-slate-400',
                'block flex-1 rounded-lg px-4 py-2 font-semibold duration-200 hover:bg-slate-700 hover:text-amber-300',
            ]"
            :href="`/chat/${message.id}`"
        >
            {{ message.context[0].content.substring(0, 20) }}
        </Link>

        <!-- Only render the delete button if this is the active chat -->
        <div
            v-if="message.id === chat?.id"
            class="hidden justify-between px-2 group-hover:flex"
        >
            <button
                class="text-xs text-slate-400 duration-200 hover:text-red-500"
            >
                <Link :href="route('chat.destroy', chat?.id)" method="delete">
                    <svg
                        class="size-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21
                       c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673
                       a2.25 2.25 0 0 1-2.244 2.077H8.084
                       a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0
                       a48.108 48.108 0 0 0-3.478-.397m-12 .562
                       c.34-.059.68-.114 1.022-.165m0 0
                       a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916
                       c0-1.18-.91-2.164-2.09-2.201
                       a51.964 51.964 0 0 0-3.32 0
                       c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0
                       a48.667 48.667 0 0 0-7.5 0"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </Link>
            </button>
        </div>
    </li>
</template>
