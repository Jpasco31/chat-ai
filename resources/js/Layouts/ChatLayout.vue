<script lang="ts" setup>
import UserHeader from '@/Pages/Chat/Partials/UserHeader.vue';
</script>

<template>
    <div class="flex h-screen w-screen overflow-hidden">
        <!-- SIDEBAR / ASIDE -->
        <aside
            class="fixed top-0 z-10 ml-[-100%] h-screen w-full flex-col justify-between border-r border-slate-700 bg-slate-800 px-4 pb-3 transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]"
        >
            <slot name="aside" />
        </aside>

        <!-- MAIN AREA -->
        <div class="ml-auto flex flex-col lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
            <!-- USER INFO HEADER -->
            <UserHeader :route="route" :userName="$page.props.auth.user.name" />

            <div class="relative flex-1 pb-32 pt-6">
                <main>
                    <slot />
                </main>
            </div>

            <!-- FORM SLOT -->
            <div
                class="fixed bottom-0 z-20 h-28 w-[90%] bg-slate-900 bg-opacity-70 shadow-2xl md:w-[80%] lg:w-[75%] lg:py-2.5 xl:w-[80%] 2xl:w-[85%]"
            >
                <slot name="form" />
            </div>
        </div>
    </div>
</template>
