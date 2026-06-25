<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import DashboardCard from '@/Components/DashboardCard.vue'

// ログインユーザー
const user = usePage().props.auth.user
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        図書館管理システム 📚
      </h2>
    </template>

    <div class="min-h-screen bg-[#faf8f2] py-12">
      <div class="mx-auto max-w-6xl px-4">

        <!-- Welcome -->
        <div class="mb-10">
          <h1 class="text-2xl font-bold text-gray-800">
            ようこそ、{{ user.name }} さん
          </h1>
          <p class="text-sm text-gray-600 mt-1">
            図書館管理システムのダッシュボードです 📚
          </p>
        </div>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- 本の管理 -->
        <DashboardCard
        title="本の管理"
        description="書籍・冊子・貸出管理を行います"
        icon="📚"
        subIcon="📖"
        href="/books"
        note="▶ 管理画面を開く"
        main
        />

        <!-- 貸出・返却 -->
        <DashboardCard
        title="貸出・返却"
        description="冊子番号を入力してすぐに操作"
        icon="📕"
        subIcon="⏱️"
        href="/loans/quick"
        note="▶ クイック操作へ"
        />

        <!-- 利用者管理 -->
        <DashboardCard
        title="利用者管理"
        description="利用者情報の登録・確認を行います"
        icon="👤"
        subIcon="🗂️"
        note="準備中"
        />

        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

