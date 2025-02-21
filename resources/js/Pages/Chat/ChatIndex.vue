<script lang="ts" setup>
import ChatLayout from '@/Layouts/ChatLayout.vue';
import ChatAside from '@/Pages/Chat/Partials/ChatAside.vue';
import ChatDefault from '@/Pages/Chat/Partials/ChatDefault.vue';
import ChatForm from '@/Pages/Chat/Partials/ChatForm.vue';
import UserHeader from '@/Pages/Chat/Partials/UserHeader.vue';
import Edit from '@/Pages/Profile/Edit.vue';
import { Chat, Message } from '@/types/message';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, nextTick, onMounted, reactive, ref, watch } from 'vue';

const props = defineProps<{
    messages: Message[];
    chat: Chat | null;
}>();

const form = useForm({
    prompt: '',
});

const editProfile = ref<InstanceType<typeof Edit> | null>(null);

const localChat = reactive<Chat>({
    id: props.chat?.id ?? 0,
    context: props.chat?.context ? [...props.chat.context] : [],
});

const handleSubmit = () => {
    // Remove the early return so it always attempts to post:
    localChat.context.push({
        role: 'assistant',
        content: '',
    });

    // Decide URL based on whether we have a chat ID or not
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

const title = computed(() => {
    const content = props.chat?.context?.[0]?.content ?? '';
    return content
        ? content.substring(0, 15) + (content.length > 15 ? '...' : '')
        : 'New Chat';
});

// Parent method that calls the child's exposed method
function handleOpenProfileModal() {
    if (editProfile.value) {
        // This calls the method we exposed in Edit.vue
        editProfile.value.openModal();
    }
}
</script>

<template>
    <Head :title="title" />
    <ChatLayout>
        <template #header>
            <UserHeader
                :route="route"
                :userName="$page.props.auth.user.name"
                @openProfileModal="handleOpenProfileModal"
            />
        </template>

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
    <!-- Render the Profile Edit component offscreen until needed -->
    <Edit ref="editProfile" />
</template>
