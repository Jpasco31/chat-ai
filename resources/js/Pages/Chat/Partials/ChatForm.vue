<!-- ChatForm.vue -->
<script lang="ts" setup>
import { defineEmits, defineProps, ref } from 'vue';

defineProps<{
    modelValue: string;
    processing: boolean;
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', value: string): void;
    (e: 'submit'): void;
}>();

const chatAreaRef = ref<HTMLTextAreaElement | null>(null);

function autoResizeChatArea() {
    const el = chatAreaRef.value;
    if (!el) return;

    // Reset height so it shrinks on backspace
    el.style.height = 'auto';

    // Calculate the computed line height and max height
    const computedLineHeight = window.getComputedStyle(el).lineHeight;
    const lineHeight = computedLineHeight ? parseInt(computedLineHeight) : 24;
    const maxHeight = lineHeight * 5; // Allow up to 5 lines

    // Update the height and overflow behavior based on content size
    el.style.height = Math.min(el.scrollHeight, maxHeight) + 'px';
    if (el.scrollHeight <= maxHeight) {
        el.style.overflow = 'hidden';
    } else {
        el.style.overflow = 'auto';
    }
}

function submit() {
    emit('submit');
}
</script>

<template>
    <section class="p-4">
        <div class="relative flex items-center">
            <textarea
                ref="chatAreaRef"
                :disabled="processing"
                :value="modelValue"
                class="w-full resize-none rounded-lg bg-slate-800 px-4 py-4 text-sm text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                placeholder="Type your message..."
                rows="1"
                @input="
                    (e) => {
                        const target = e.target as HTMLTextAreaElement;
                        emit('update:modelValue', target.value);
                        autoResizeChatArea();
                    }
                "
                @keydown.enter.exact.prevent="submit"
            />
            <button
                :class="[
                    !processing ? 'px-4' : 'pl-4 pr-8',
                    'absolute inset-y-0 right-0 flex items-center',
                ]"
                :disabled="processing"
                @click="submit"
            >
                <svg
                    v-if="!processing"
                    class="h-10 w-10 text-amber-500 hover:text-amber-300"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        clip-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm.53 5.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 1 0 1.06 1.06l1.72-1.72v5.69a.75.75 0 0 0 1.5 0v-5.69l1.72 1.72a.75.75 0 1 0 1.06-1.06l-3-3Z"
                        fill-rule="evenodd"
                    />
                </svg>
                <div v-else class="dot-typing"></div>
            </button>
        </div>
    </section>
</template>
