<script setup lang="ts">
defineProps<{
  items: {
    label: string
    href?: string
  }[]
}>()
</script>

<template>
  <nav class="mb-4 text-sm text-gray-500">
    <ol class="flex flex-wrap items-center gap-1">
      <li
        v-for="(item, index) in items"
        :key="index"
        class="flex items-center"
      >
        <template v-if="item.href">
          <a
            :href="item.href"
            class="hover:underline text-blue-600"
          >
            {{ item.label }}
          </a>
        </template>
        <template v-else>
          <span class="text-gray-700 font-medium">
            {{ item.label }}
          </span>
        </template>

        <span v-if="index < items.length - 1" class="mx-1">
          &gt;
        </span>
      </li>
    </ol>
  </nav>
</template>
