<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import type {Task} from "@/Types/task";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    task: Object as () => Task
})


</script>

<template>
    <AppLayout title="Show Task">

        <template #header>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">
                    {{ task.title }}
                </h1>
                <Link :href="route('tasks.index')"
                      class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-6 px-8 my-4">
                    <h1 class="text-2xl font-bold py-2">{{ task.title }}</h1>
                    <hr>
                    <p class="text-gray-500 py-4">{{ task.description }}</p>

                    <small class="text-sm">created {{ task.created_ago }}</small>

                    <div class="flex gap-1 mt-4">
                        <Link :href="route('tasks.index')"
                              class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back
                        </Link>
                        <Link :href="route('tasks.edit', task.id)"
                              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </Link>
                        <Link :href="route('tasks.destroy', task.id)"
                              class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </Link>
                    </div>

                </div>
            </div>
        </div>

    </AppLayout>
</template>

<style scoped>

</style>
