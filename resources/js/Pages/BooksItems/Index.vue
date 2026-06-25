<script setup lang="ts">
import { Head, router, Link, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps<{
  items: any[]
  book?: any
  //パンくずリスト
  breadcrumbs: {
    label: string
    url?: string
  }[]
}>()

// 借りる / 返す
const borrowItem = (itemId: number) => {
  router.post(route('books-items.borrow', itemId))
}

const returnItem = (itemId: number) => {
  router.post(route('books-items.return', itemId))
}

</script>


<template>
  <AuthenticatedLayout>
    <Head title="冊子一覧" />

    <div class="max-w-6xl mx-auto py-10">
      
      <h1 class="text-2xl font-bold mb-6">📕 冊子一覧</h1>

      <!-- ★ 親があるときだけ表示 -->
      <div v-if="props.book" class="mb-6">
        <Link
          :href="route('books.items.create', props.book.id)"
          class="inline-flex items-center px-4 py-2 mb-4 bg-indigo-600 text-white rounded hover:bg-indigo-700"
        >
          ＋ この本に冊子を追加
        </Link>
      </div>

      <div v-if="items.length === 0" class="bg-white p-6 rounded shadow text-center">
          <p class="text-gray-600">
              📭 この本には、まだ冊子が登録されていません
          </p>
      </div>

      <table class="w-full border-collapse bg-white shadow">
        <thead>
          <tr class="bg-gray-100">
            <th class="border px-3 py-2">ID</th>
            <th class="border px-3 py-2">タイトル</th>
            <th class="border px-3 py-2">管理番号</th>
            <th class="border px-3 py-2">状態</th>
            <th class="border px-3 py-2">操作</th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="item in props.items"
            :key="item.id"
            class="hover:bg-gray-50"
          >
            <td class="border px-3 py-2">{{ item.id }}</td>

            <td class="border px-3 py-2">
              {{ item.book?.title ?? '（不明）' }}
            </td>

            <td class="border px-3 py-2">
              {{ item.item_number }}
            </td>

            <td class="border px-3 py-2">
              <span
                :class="{
                  'text-green-600': item.status === 'available',
                  'text-red-600': item.status === 'loaned',
                }"
              >
                {{ item.status === 'available' ? '貸出可' : '貸出中' }}
              </span>
            </td>

            <td class="border px-3 py-2">
              <button
                v-if="item.status === 'available'"
                @click="borrowItem(item.id)"
                class="px-3 py-1 bg-blue-600 text-white rounded mr-2"
              >
                借りる
              </button>

              <button
                v-if="item.status === 'loaned'"
                @click="returnItem(item.id)"
                class="px-3 py-1 bg-green-600 text-white rounded"
              >
                返す
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AuthenticatedLayout>
</template>
