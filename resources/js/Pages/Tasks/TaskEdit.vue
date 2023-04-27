<script setup lang="ts">
import type {Task} from "@/Types/task";
import AppLayout from "@/Layouts/AppLayout.vue";
import TaskForm from "@/Components/Forms/TaskForm.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    task: Object as Task,
})
</script>

<template>
    <AppLayout :title="`Edit ${task.title}`">

        <template #header>
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold">
                    Edit Task
                </h1>
                <Link :href="route('tasks.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-6 px-8 my-4">
                    <TaskForm :task="task" />
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<style scoped>

</style>
