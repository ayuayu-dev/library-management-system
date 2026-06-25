<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link, usePage } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen bg-[#faf8f2] flex flex-col items-center justify-center px-4">

        <!-- 🚨 ここを「ログイン系ページ専用ロゴ」にする -->
        <div v-if="$page.component.startsWith('Auth/')"
            class="mb-8">
            <Link href="/">
                <ApplicationLogo class="w-[280px] h-auto" />
            </Link>
        </div>

        <!-- カード部分 -->
        <div class="w-full bg-white px-6 py-6 shadow-lg sm:max-w-md rounded-2xl">
            <slot />
        </div>
    </div>
</template>
