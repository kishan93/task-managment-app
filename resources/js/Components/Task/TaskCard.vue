<template>
  <div class="bg-gray-50 shadow-md border border-gray-300 p-5 m-4 rounded-md" @dragover.prevent="handleDragOver">
    <div class="flex">
      <div class="w-full content-between text-w">
        <div class="text-md text-gray-900">
          <InertiaLink class="text-blue-500 font-bold" :href="route('tasks.show', task.id)">
            {{ task.title }}
          </InertiaLink>
        </div>
      </div>
    </div>
    <div class="flex mt-3">
      <div class="w-full content-between flex space-x-2">
        <p class="rounded-full max-w-max px-3 w-auto font-mono border border-red-500 text-gray-900">
          {{ task.created_date }}
        </p>
      </div>
      <div class="mx-1 w-1/2">
        <p class="rounded-full px-2 text-center  border text-gray-900 border-green-500 capitalize">{{ taskStatus }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { InertiaLink } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const props = defineProps({
  task: Object,
})

const taskStatus = computed(() => {
  return !props.task.status ? 'pending' : props.task.status
})

</script>

<style scoped>

</style>
