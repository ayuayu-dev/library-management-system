<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BookForm from './BookForm.vue';

const props = defineProps(['book', 'categories']);

console.log('props:', props);


// 編集用フォーム（初期値は既存データ）
const form = useForm({
  title: props.book.title,
  author: props.book.author,
  publisher: props.book.publisher,
  isbn: props.book.isbn,
  category_id: props.book.category_id,
  description: props.book.description,
  published_year: props.book.published_year,
  // 編集時は stock を直接更新しない想定でもOK
  stock: props.book.stock ?? 0,
});

const submit = () => {
  form.put(route('books.update', props.book.id));
};

//console.log(props.book);
</script>

<template>
  <AuthenticatedLayout>
    <div class="max-w-3xl mx-auto mt-8">
      <h1 class="text-2xl font-bold mb-6">✏️ 本の情報を編集</h1>

      <BookForm
        :form="form"
        :categories="props.categories"
        :isEdit="true"
        :onSubmit="submit"
      />
      <div v-if="false" class="mt-8 border-t pt-4">
        <!-- 冊子管理 -->
        <div class="mt-8 border-t pt-4 text-sm text-gray-700">
          <p class="mb-2 font-semibold">冊子管理</p>

          <Link
            :href="route('books.items.create', props.book.id)"
            class="inline-flex items-center gap-1 text-blue-600 hover:underline"
          >
            ➕ 冊子を追加登録
          </Link>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
