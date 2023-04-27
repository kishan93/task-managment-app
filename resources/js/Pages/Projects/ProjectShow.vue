<script setup lang="ts">
import type {Project} from "@/js/Types/project";
import {Link} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    project: Object as Project,
})

</script>

<template>
    <AppLayout :title="`${project.title}`">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-6 px-8 my-4">
                    <h1 class="text-2xl font-bold py-2">{{ project.title }}</h1>
                    <hr>
                    <p class="text-gray-500 py-4">{{ project.description }}</p>

                    <small class="text-sm">created {{ project.created_ago }}</small>

                    <div class="mt-4">
                        <Link :href="route('projects.index')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</Link>
                    </div>

                </div>
            </div>
        </div>

    </AppLayout>
</template>

<style scoped>

</style>
