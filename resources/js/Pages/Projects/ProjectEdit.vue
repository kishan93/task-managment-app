<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import AppLayout from "@/Layouts/AppLayout.vue";
import type {Project} from "@/Types/project";
import ProjectForm from "@/Components/Forms/ProjectForm.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    project: Object as Project,
})

const form = useForm({
    ...props.project,
})

const updateProject = () => {
    form.put(route('projects.update', props.project.id))
}

</script>

<template>
    <AppLayout :title="`Edit ${project.title}`">

        <template #header>
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold">
                    Edit Project
                </h1>
                <Link :href="route('projects.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-6 px-8 my-4">
                    <ProjectForm :form="form" :submit="updateProject" />
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<style scoped>

</style>
