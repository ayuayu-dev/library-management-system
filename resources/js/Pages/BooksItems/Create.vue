<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps<{ book: any }>();

const form = useForm({
  inventory_code: '',
  status: 'available',
});

const submit = () => {
  form.post(route('books.items.store', props.book.id));
};
</script>

<template>
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-2">
      📚 冊子追加（{{ book.title }}）
    </h2>

    <div class="mb-4">
      <label class="block text-sm mb-1">管理番号</label>
      <input
        v-model="form.inventory_code"
        class="w-full border rounded px-3 py-2"
      />
    </div>

    <div class="mb-4">
      <label class="block text-sm mb-1">状態</label>
      <select v-model="form.status" class="w-full border rounded px-3 py-2">
        <option value="available">在庫</option>
        <option value="loaned">貸出中</option>
        <option value="lost">紛失</option>
        <option value="damaged">破損</option>
      </select>
    </div>

    <div class="flex gap-2">
      <button
        @click="submit"
        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
      >
        追加する
      </button>

      <Link
        :href="route('books.items.index', book.id)"
        class="px-4 py-2 border rounded"
      >
        戻る
      </Link>
    </div>
  </div>
</template>
