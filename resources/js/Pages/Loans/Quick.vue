<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head ,useForm } from '@inertiajs/vue3'

const form = useForm({
  item_number: '',
});

const submit = () => {
  form.post(route('loans.quick.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset('item_number');
    },
  });
};

</script>

<template>
  <AuthenticatedLayout>
    <Head title="貸出・返却" />

    <div class="min-h-screen bg-[#faf8f2] py-12">
      <div class="mx-auto max-w-xl">

        <!-- カード -->
        <div class="bg-white rounded-2xl shadow p-8">
          <form @submit.prevent="submit">

            <!-- タイトル -->
            <h1 class="text-2xl font-bold text-gray-800 mb-2 flex items-center gap-2">
              📕 貸出・返却
            </h1>

            <p class="text-sm text-gray-600 mb-6">
              冊子番号を入力して、貸出または返却を行います
            </p>

            <!-- 入力欄 -->
            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-2">
                冊子番号
              </label>

              <input
                v-model="form.item_number"
                type="text"
                placeholder="バーコードを読み取るか、番号を入力してください"
                class="w-full rounded-lg border px-4 py-3 text-lg
                      focus:outline-none focus:ring-2 focus:ring-green-400"
                autofocus
              />
            </div>

            <!-- ボタン -->
            <div class="flex gap-4">
              <button
                type="button"
                class="flex-1 bg-blue-600 text-white py-3 rounded-lg
                      hover:bg-blue-700 transition font-semibold"
              >
                貸出
              </button>

              <button
                type="button"
                class="flex-1 bg-green-600 text-white py-3 rounded-lg
                      hover:bg-green-700 transition font-semibold"
              >
                返却
              </button>
            </div>

            <!-- 補足 -->
            <p class="mt-6 text-xs text-gray-500">
              ※ バーコードリーダー使用時は自動で番号が入力されます
            </p>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
