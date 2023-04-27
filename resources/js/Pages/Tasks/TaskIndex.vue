<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link, useForm} from "@inertiajs/vue3";
import type {Task} from "@/js/Types/task";
import draggable from "vuedraggable";

const props = defineProps({
    tasks: Array as () => Task[]
})

const form = useForm({
    _method: 'DELETE'
})

const onDelete = (id: number) => {
    if (confirm('Are you sure you want to delete this task?')) {
        form.delete(route('tasks.destroy', id))
    }
}
</script>

<template>
    <AppLayout title="Tasks">

        <template #header>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">
                    Tasks
                </h1>
                <Link :href="route('tasks.create')"
                      class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Create
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">

                                    <table class="w-full">
                                        <thead class="">
                                            <tr>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    #
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Title
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Status
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Created
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template v-if="tasks.length < 1">
                                                <tr>
                                                    <td
                                                        class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-100"
                                                        colspan="6">No Tasks found
                                                    </td>
                                                </tr>
                                            </template>

                                            <tr v-for="(task, index) in tasks" class="bg-white border-t">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ index + 1 }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ task.title }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap capitalize">
                                                    {{ task.status ? task.status : 'pending' }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ task.created_ago }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap space-x-2 flex gap-1">
                                                    <Link :href="route('tasks.show', task.id)"
                                                          class="py-1 px-4 bg-green-500 text-white rounded-full">
                                                        View
                                                    </Link>
                                                    <Link :href="route('tasks.edit', task.id)"
                                                          class="py-1 px-4 bg-blue-500 text-white rounded-full">
                                                        Edit
                                                    </Link>
                                                    <button @click.prevent="onDelete(task.id)"
                                                            class="py-1 px-4 bg-red-600 text-white rounded-full">Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
