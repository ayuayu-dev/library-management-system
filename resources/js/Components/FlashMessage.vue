<script setup lang="ts">
import { ref, watch } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const flashMessage = ref<string | null>(null)
const isVisible = ref(false)

watch(
  () => page.props.flash?.success,
  (message) => {
    if (!message) return

    flashMessage.value = message
    isVisible.value = true

    setTimeout(() => {
      isVisible.value = false
    }, 3000)

    setTimeout(() => {
      flashMessage.value = null
    }, 3500)
  },
  { immediate: true }
)
</script>

<template>
  <div
    v-show="flashMessage"
    class="mb-4 rounded bg-green-100 px-4 py-2 text-green-700
           transition-opacity duration-500"
    :class="isVisible ? 'opacity-100' : 'opacity-0'"
  >
    {{ flashMessage }}
  </div>
</template>
