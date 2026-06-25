<script setup>
defineProps({
  form: Object,
  categories: Array,
  isEdit: Boolean,
  onSubmit: Function,
});
</script>

<template>
  <form @submit.prevent="onSubmit" class="space-y-4">

    <!-- タイトル -->
    <div>
      <label class="block text-sm font-bold mb-1">タイトル</label>
      <input
        v-model="form.title"
        type="text"
        class="w-full border rounded px-3 py-2"
        placeholder="例：ハリーポッターと賢者の石"
      />
      <p v-if="form.errors.title" class="text-red-600 text-sm">
        {{ form.errors.title }}
      </p>
    </div>

    <!-- 著者 -->
    <div>
      <label class="block text-sm font-bold mb-1">著者</label>
      <input
        v-model="form.author"
        type="text"
        class="w-full border rounded px-3 py-2"
        placeholder="例：J.K.ローリング"
      />
    </div>

    <!-- カテゴリ -->
    <div>
      <label class="block text-sm font-bold mb-1">カテゴリ</label>
      <select v-model="form.category_id" class="w-full border rounded px-3 py-2">
        <option value="" disabled>カテゴリを選んでね</option>
        <option
          v-for="category in categories"
          :key="category.id"
          :value="category.id"
        >
          {{ category.name }}
        </option>
      </select>
    </div>

    <!-- 説明 -->
    <div>
      <label class="block text-sm font-bold mb-1">説明</label>
      <textarea
        v-model="form.description"
        class="w-full border rounded px-3 py-2"
        placeholder="例：ホグワーツでの冒険が始まる！"
      ></textarea>
    </div>

    <!-- 出版社 -->
    <div>
      <label class="block text-sm font-bold mb-1">出版社</label>
      <input
        v-model="form.publisher"
        type="text"
        class="w-full border rounded px-3 py-2"
        placeholder="例：静山社"
      />
    </div>

    <!-- 出版年 -->
    <div>
      <label class="block text-sm font-bold mb-1">出版年</label>
      <input
        v-model="form.published_year"
        type="number"
        class="w-full border rounded px-3 py-2"
        placeholder="例：1999"
      />
    </div>

    <!-- ISBN -->
    <div>
      <label class="block text-sm font-bold mb-1">ISBN</label>
      <input
        v-model="form.isbn"
        type="text"
        class="w-full border rounded px-3 py-2"
        placeholder="例：978-4-915512-05-6"
      />
    </div>

    <!-- 在庫数 -->
    <div>
      <label class="block text-sm font-bold mb-1">
        {{ isEdit ? '在庫数（参考）' : '在庫数' }}
      </label>
      <input
        v-model="form.start_stock"
        type="number"
        min="1"
        class="w-full border rounded px-3 py-2"
        placeholder="例：3"
      />
    </div>

    <!-- 送信ボタン -->
    <button
      type="submit"
      class="px-4 py-2 bg-blue-600 text-white font-bold rounded hover:bg-blue-700"
      :disabled="form.processing"
    >
      {{ isEdit ? '更新する' : '登録する！' }}
    </button>

  </form>
</template>
