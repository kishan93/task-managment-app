<script setup lang="ts">
import type {Project} from "@/js/Types/project";
import axios from "axios";
import {Link, useForm} from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    projects: {
        type: Array as () => Project[],
        required: true,
    }
})

const form = useForm({
    _method: 'DELETE'
})

const deleteProject = (id: number) => {
    if (confirm('Are you sure you want to delete this project?')) {
        form.delete(route('projects.destroy', id))
    }
}
</script>

<template>
    <AppLayout title="Projects">

        <template #header>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">
                    Projects
                </h1>
                <Link :href="route('projects.create')"
                      class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Create
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">

                    <!-- Table -->
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="table-auto w-full">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Title
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
                                            <!-- loop through projects -->
                                            <tr v-for="project in projects" :key="project.id" class="bg-white border-t">
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap space-x-2 flex gap-1 px-4 py-2">
                                                    {{ project.title }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ project.created_ago }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap flex gap-1">
                                                    <Link :href="route('projects.show', project.id)"
                                                          class="py-1 px-4 bg-green-500 text-white rounded-full">
                                                        View
                                                    </Link>
                                                    <Link :href="route('projects.edit', project.id)"
                                                          class="py-1 px-4 bg-blue-500 text-white rounded-full">
                                                        Edit
                                                    </Link>
                                                    <button class="py-1 px-4 bg-red-600 text-white rounded-full"
                                                            @click.prevent="deleteProject(project.id)">
                                                        Delete
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
