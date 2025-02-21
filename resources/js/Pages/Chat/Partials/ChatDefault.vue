<!-- ChatDefault.vue -->
<script lang="ts" setup>
import ChatContent from '@/Pages/Chat/Partials/ChatContent.vue';
import { Chat } from '@/types/message';
import { defineProps, nextTick, onMounted, ref, watch } from 'vue';

// Props
const props = defineProps<{
    chat: Chat | null;
    processing: boolean;
}>();

// The container that actually holds the messages:
const chatContainer = ref<HTMLDivElement | null>(null);

function scrollToBottom() {
    if (!chatContainer.value) return;
    // Scroll all the way down
    chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
}

// Scroll on mount:
onMounted(() => {
    scrollToBottom();
});

// Also watch when context changes and scroll:
watch(
    () => props.chat?.context.length,
    async () => {
        await nextTick();
        scrollToBottom();
    },
);
</script>

<template>
    <div
        ref="chatContainer"
        class="h-[calc(100vh-12rem)] flex-1 overflow-y-auto px-2 md:px-16 lg:px-28"
    >
        <template v-if="chat">
            <div class="flex flex-col space-y-4">
                <template v-for="(context, index) in chat.context" :key="index">
                    <ChatContent
                        :context="context"
                        :loading="
                            processing &&
                            index === chat.context.length - 1 &&
                            context.role === 'assistant'
                        "
                    />
                </template>
            </div>
        </template>
    </div>
</template>
