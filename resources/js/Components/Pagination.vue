<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: {
    type: Array,
    default: () => [],
  },
})
</script>

<template>
  <nav
    v-if="links.length > 1"
    class="flex justify-center items-center gap-1"
  >
    <template v-for="link in links" :key="link.label">
      <!-- クリックできるページ -->
      <Link
        v-if="link.url"
        :href="link.url"
        v-html="link.label"
        class="px-3 py-1 text-sm border rounded
               hover:bg-indigo-50 hover:text-indigo-700
               transition"
        :class="{
          'bg-indigo-600 text-white border-indigo-600': link.active,
        }"
      />

      <!-- クリックできない（前へ / 次へ / …） -->
      <span
        v-else
        v-html="link.label"
        class="px-3 py-1 text-sm border rounded
               text-gray-400 bg-gray-100 cursor-not-allowed"
      />
    </template>
  </nav>
</template>
