<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {computed} from 'vue'
import type {Task} from "@/Types/task";

const props = defineProps({
    task: Object as () => Task,
})

const taskStatus = computed(() => {
    return !props.task.status ? 'pending' : props.task.status
})

</script>
<template>
    <div class="bg-gray-50 shadow-md border border-gray-300 p-5 m-4 rounded-md" @dragover.prevent="handleDragOver">
        <div class="flex">
            <div class="w-full content-between text-w">
                <div class="text-md text-gray-900">
                    <Link class="text-blue-500 font-bold" :href="route('tasks.show', task.id)">
                        {{ task.title }}
                    </Link>
                </div>
            </div>
        </div>
        <div class="flex mt-3">
            <div class="w-full content-between flex space-x-2">
                <p class="rounded-full max-w-max px-3 w-auto font-mono border border-red-500 text-gray-900">
                    {{ task.created_ago  }}
                </p>
            </div>
        </div>
    </div>
</template>
