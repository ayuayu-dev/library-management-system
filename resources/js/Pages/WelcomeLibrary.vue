<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
</script>

<template>
    <Head title="図書館管理システム" />

    <div class="min-h-screen bg-[#faf8f2] flex items-center justify-center px-10">

        <div class="flex flex-col sm:flex-row items-center justify-center gap-12">

            <!-- 左：ロゴ -->
            <div class="opacity-0 animate-slide-up-fade">
                <ApplicationLogo class="w-[300px] h-auto" />
            </div>

            <!-- 右：テキスト + ボタン -->
            <div class="animate-fade-in space-y-6">

                <h1 class="text-3xl font-bold text-gray-800">
                    図書館管理システム 📚
                </h1>

                <p class="text-gray-600 max-w-sm leading-relaxed">
                    図書館の本の管理や貸出業務をサポートするシステムです。  
                    はじめにログインして、管理画面へお進みください。
                </p>

                <div class="flex gap-4">
                    <Link
                        href="/login"
                        class="px-6 py-3 rounded-xl text-white bg-[#8d6e63]
                            hover:bg-[#795548] active:bg-[#6d4c41]
                            transition font-semibold shadow"
                    >
                        ログイン
                    </Link>

                    <Link
                        href="/register"
                        class="px-6 py-3 rounded-xl bg-white border border-[#8d6e63]
                            text-[#8d6e63] hover:bg-[#f3ede7] active:bg-[#e9e2dd]
                            transition font-semibold shadow"
                    >
                        新規登録
                    </Link>
                </div>

            </div>
        </div>

    </div>
</template>
