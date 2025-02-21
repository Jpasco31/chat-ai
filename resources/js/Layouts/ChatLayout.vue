<script lang="ts" setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';

const isAsideOpen = ref(false);

function toggleAside() {
    isAsideOpen.value = !isAsideOpen.value;
}

// Checks window width and sets isAsideOpen accordingly
function checkScreenSize() {
    isAsideOpen.value = window.innerWidth >= 768;
}

onMounted(() => {
    // Check on mount
    checkScreenSize();
    // Check on window resize
    window.addEventListener('resize', checkScreenSize);
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', checkScreenSize);
});
</script>

<template>
    <div class="flex h-screen w-screen overflow-hidden">
        <!-- MOBILE HAMBURGER BUTTON -->
        <button
            :class="[
                'absolute left-2 top-2 z-20 block rounded bg-slate-700 p-2 text-white md:hidden',
                isAsideOpen ? 'opacity-50' : 'opacity-100',
            ]"
            @click="toggleAside"
        >
            <!-- Hamburger icon -->
            <svg
                class="h-6 w-6"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                viewBox="0 0 24 24"
            >
                <path
                    d="M3.75 5.25h16.5M3.75 12h16.5M3.75 18.75h16.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </button>

        <!-- SIDEBAR / ASIDE -->
        <aside
            :class="[
                'fixed top-0 z-10 h-screen border-r border-slate-700 bg-slate-800 px-4 pb-3',
                'w-[75%] sm:w-[50%] md:w-4/12 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]',
                isAsideOpen ? 'translate-x-0' : '-translate-x-full',
                'transition-transform duration-300 md:relative md:ml-0 md:translate-x-0',
            ]"
        >
            <slot name="aside" />
        </aside>

        <!-- MAIN AREA -->
        <!-- Use flex-col so we can push the form slot to the bottom via sticky -->
        <div
            class="ml-auto flex flex-1 flex-col md:w-[60%] lg:w-[75%] xl:w-[80%] 2xl:w-[85%]"
        >
            <!-- HEADER SLOT -->
            <slot name="header" />

            <!-- SCROLLABLE CONTENT -->
            <div class="flex-1 overflow-y-auto p-6">
                <main>
                    <slot />
                </main>
            </div>

            <!-- FORM SLOT AT THE BOTTOM -->
            <!-- Use `sticky bottom-0` so it stays pinned at the bottom of its parent,
                 as long as the parent has a height and scrolling is on .flex-1 above. -->
            <div class="sticky bottom-0 bg-slate-900 bg-opacity-70 shadow-2xl">
                <slot name="form" />
            </div>
        </div>
    </div>
</template>
