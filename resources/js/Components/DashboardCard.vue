<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

defineProps<{
  title: string
  description: string
  icon: string
  href?: string
  main?: boolean
  note?: string
  subIcon?: string
}>()
</script>

<template>
  <component
    :is="href ? Link : 'div'"
    :href="href"
    class="block bg-white rounded-xl border border-gray-200
           shadow-sm hover:shadow-md transition"
    :class="[
      main
        ? 'p-6 sm:p-8 md:col-span-2'
        : 'p-4 sm:p-6'
    ]"
  >
    <div class="flex items-center gap-5">
      <!-- アイコン -->
      <div
        class="shrink-0"
        :class="main
          ? 'text-4xl sm:text-5xl'
          : 'text-3xl sm:text-4xl'"
      >
        {{ icon }}
      </div>

      <!-- テキスト -->
      <div class="flex-1">
        <h3
          class="font-bold text-gray-800 flex items-center gap-2"
          :class="main
            ? 'text-xl sm:text-2xl'
            : 'text-lg sm:text-xl'"
        >
          {{ title }}

          <!-- サブアイコン -->
          <span
            v-if="subIcon"
            class="text-sm text-gray-400"
          >
            {{ subIcon }}
          </span>
        </h3>

        <p class="text-sm text-gray-600 mt-1">
          {{ description }}
        </p>

        <p
          v-if="note"
          class="mt-1 sm:mt-2 text-sm"
          :class="href ? 'text-blue-600 font-medium' : 'italic text-gray-500'"
        >
          {{ note }}
        </p>
      </div>
    </div>
  </component>
</template>
