<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BookForm from './BookForm.vue';

const props = defineProps({
  categories: Array,
});

const form = useForm({
  title: '',
  author: '',
  publisher: '',
  isbn: '',
  category_id: 1,
  description: '',
  published_year: null,
  start_stock: 1,
});

const submit = () => {
  form.post(route('books.store'));
};
</script>

<template>
  <AuthenticatedLayout>
    <div class="max-w-3xl mx-auto mt-8">
      <h1 class="text-2xl font-bold mb-6">📘 本を登録する</h1>

      <BookForm
        :form="form"
        :categories="props.categories"
        :isEdit="false"
        :onSubmit="submit"
      />
    </div>
  </AuthenticatedLayout>
</template>
