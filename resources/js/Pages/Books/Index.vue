<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, Link } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'
import { ref } from 'vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'

const openBooks = ref<number[]>([])

const toggleBook = (bookId: number) => {
  if (openBooks.value.includes(bookId)) {
    openBooks.value = openBooks.value.filter(id => id !== bookId)
  } else {
    openBooks.value.push(bookId)
  }
}

const isOpen = (bookId: number) => {
  return openBooks.value.includes(bookId)
}

const props = defineProps<{
  books: {
    data: any[]
    links?: any[]
    meta?: any
  }
  filters?: {
    keyword?: string
  }
}>()

const form = useForm({
  keyword: props.filters?.keyword ?? '',
})

const search = () => {
  form.get(route('books.index'), {
    preserveState: true,
    preserveScroll: true,
  })
}

const statusMap: Record<string, { label: string; class: string }> = {
  available: {
    label: '貸出可',
    class: 'bg-green-100 text-green-700',
  },
  loaned: {
    label: '貸出中',
    class: 'bg-blue-100 text-blue-700',
  },
  lost: {
    label: '紛失',
    class: 'bg-red-100 text-red-700',
  },
  damaged: {
    label: '破損',
    class: 'bg-orange-100 text-orange-700',
  },
}

</script>



<template>

  <AuthenticatedLayout>

    <Head title="本の一覧" />

    <div class="max-w-5xl mx-auto py-10 space-y-6">

        <h1 class="text-2xl font-bold">📚 本の一覧</h1>

        <form @submit.prevent="search" class="mb-6 flex gap-2 max-w-md mx-auto">
        <input
            v-model="form.keyword"
            type="text"
            placeholder="タイトルで検索"
            class="flex-1 rounded border px-3 py-2 text-sm"
        />

        <button
            type="submit"
            class="rounded bg-indigo-600 px-4 py-2 text-sm text-white hover:bg-indigo-700"
        >
            検索
        </button>
        </form>

        <div class="flex justify-end">
        <Link
            href="/books/create"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm"
        >
            ➕ 書籍を新規登録
        </Link>
        </div>

        <Pagination
        v-if="props.books.links && props.books.links.length"
        :links="props.books.links"
        class="mb-4"
        />

      <!-- 書籍 + 冊子ツリー -->
<div
  v-for="book in props.books.data"
  :key="book.id"
  class="border rounded-lg p-4 bg-white shadow-sm hover:shadow transition"
>
  <div class="flex justify-between items-start">
    <!-- 左側：ツリー＋情報 -->
    <button
      @click="toggleBook(book.id)"
      class="w-full text-left"
    >
      <!-- 上段：在庫数 → タイトル -->
      <div class="flex items-center gap-3 font-bold text-lg">
        <!-- 開閉 -->
        <span class="text-gray-500 w-4 inline-block">
          {{ isOpen(book.id) ? '▼' : '▶' }}
        </span>

        <!-- 在庫数（先頭・固定） -->
        <span
          class="min-w-[64px] text-center px-2 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700"
        >
          {{
            book.books_items.filter(i => i.status === 'available').length
          }}
          /
          {{ book.books_items.length }}
        </span>

        <!-- タイトル（長くなってもOK） -->
        <span
          class="truncate max-w-[32rem]"
          :title="book.title"
        >
          📘 {{ book.title }}
        </span>
      </div>

      <!-- 下段：著者 -->
      <div class="ml-6 mt-1 text-sm text-gray-600">
        著者：{{ book.author }}
      </div>
    </button>

    <!-- 右側：編集 -->
    <Link
      :href="route('books.edit', book.id)"
      class="ml-4 text-sm text-blue-600 hover:underline whitespace-nowrap"
    >
      ✏ 編集
    </Link>
  </div>

  <!-- 子：冊子一覧 -->
  <ul
    v-if="isOpen(book.id)"
    class="ml-6 mt-4 border-l pl-4 space-y-1"
  >
    <li
      v-for="item in book.books_items"
      :key="item.id"
      class="flex items-center gap-2 text-sm"
    >
      <span class="text-gray-400">📖</span>
      <span>{{ item.item_number }}</span>

    <span
      class="px-2 py-0.5 rounded-full text-xs font-semibold"
      :class="[
        statusMap[item.status]?.class,
        item.status !== 'available' ? 'opacity-70' : ''
      ]"
      :title="statusMap[item.status]?.label"
    >
      {{ statusMap[item.status]?.label }}
    </span>

    </li>
  </ul>
</div>

    </div>

    <Pagination
    v-if="props.books.links && props.books.links.length"
    :links="props.books.links"
    class="mt-6"
    />

  </AuthenticatedLayout>
</template>


