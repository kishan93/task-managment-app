<script setup lang="ts">
import type {Project} from "@/js/Types/project";
import axios from "axios";
import {Link} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    projects: {
        type: Array as () => Project[],
        required: true,
    }
})

const deleteProject = (id: number) => {
    axios.delete(route('projects.destroy', id))
}
</script>

<template>
    <AppLayout title="Projects">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <h1 class="text-2xl font-bold">
                        Projects
                    </h1>
                    <Link :href="route('projects.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</Link>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-6 px-8 my-4">


                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Created At</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- loop through projects -->
                            <tr v-for="project in projects" :key="project.id">
                                <td class="border px-4 py-2">{{ project.title }}</td>
                                <td class="border px-4 py-2">{{ project.created_ago }}</td>
                                <td class="border px-4 py-2 gap-1 flex">
                                    <Link :href="route('projects.edit', project.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</Link>
                                    <Link :href="route('projects.show', project.id)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Show</Link>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click.prevent="deleteProject(project.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </AppLayout>
</template>

<style scoped>

</style>
