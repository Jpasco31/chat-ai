<script lang="ts" setup>
import ChatLayout from '@/Layouts/ChatLayout.vue';
import ChatAside from '@/Pages/Chat/Partials/ChatAside.vue';
import ChatDefault from '@/Pages/Chat/Partials/ChatDefault.vue';
import ChatForm from '@/Pages/Chat/Partials/ChatForm.vue';
import { Chat, Message } from '@/types/message';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, nextTick, onMounted, watch } from 'vue';

const props = defineProps<{
    messages: Message[];
    chat: Chat | null;
}>();

const form = useForm({
    prompt: '',
});

const handleSubmit = () => {
    const url = props.chat ? `/chat/${props.chat?.id}` : '/chat';
    form.post(url, {
        onSuccess: async () => {
            clear();
            await nextTick();
        },
    });
};

function clear() {
    form.reset();
}

watch(
    () => props.chat?.context.length,
    async () => {
        // Whenever new messages appear
        await nextTick();
    },
);

onMounted(() => {
    clear();
});

const title = computed(() => props.chat?.context[0].content ?? 'New Chat');
</script>

<template>
    <Head :title="title" />
    <ChatLayout>
        <!-- ASIDE SLOT -->
        <template #aside>
            <ChatAside :chat="chat" :messages="messages" />
        </template>

        <template #default>
            <ChatDefault :chat="chat" :processing="form.processing" />
        </template>

        <!-- FORM SLOT -->
        <template #form>
            <ChatForm
                v-model="form.prompt"
                :processing="form.processing"
                @submit="handleSubmit"
            />
        </template>
    </ChatLayout>
</template>
