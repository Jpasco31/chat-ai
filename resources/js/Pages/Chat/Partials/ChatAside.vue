<!-- ChatAside.vue -->
<script lang="ts" setup>
import ChatListItem from '@/Pages/Chat/Partials/ChatListItem.vue';
import { Chat, Message } from '@/types/message';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

defineProps<{
    chat: Chat | null;
    messages: Message[];
}>();
</script>

<template>
    <div class="flex h-full flex-col justify-between">
        <!-- The list of chats -->
        <ul class="flex-1 overflow-y-auto p-2">
            <ChatListItem
                v-for="message in messages"
                :key="message.id"
                :chat="chat"
                :message="message"
                class="my-2"
            />
        </ul>

        <!-- The "New Chat" button pinned to the bottom -->
        <div v-if="chat" class="p-2">
            <Link
                :href="`/chat`"
                class="flex justify-between rounded-lg bg-amber-500 px-4 py-2 font-semibold text-slate-900 duration-200 hover:bg-amber-300"
            >
                New Chat
                <svg
                    class="size-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M12 4.5v15m7.5-7.5h-15"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </Link>
        </div>
    </div>
</template>
