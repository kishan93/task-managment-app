<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import AppLayout from "@/Layouts/AppLayout.vue";

const form = useForm({
    title: '',
    description: '',
})

</script>

<template>
    <AppLayout title="Create Project">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-6 px-8 my-4">
                    <form @submit.prevent="form.post(route('projects.store'))">
                        <div class="mb-4">
                            <label for="title" class="sr-only">Title</label>
                            <input id="title" type="text" v-model="form.title" :class="{ 'border-red-500': form.title.error }" class="bg-gray-100 border-2 w-full p-4 rounded-lg" placeholder="Title">
                            <div class="text-red-500 mt-2" v-if="form.errors.title">
                                {{ form.errors.title }}
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="sr-only">Description</label>
                            <textarea id="description" v-model="form.description" :class="{ 'border-red-500': form.description.error }" class="bg-gray-100 border-2 w-full p-4 rounded-lg" placeholder="Description"></textarea>
                            <div class="text-red-500 mt-2" v-if="form.description.error">
                                {{ form.errors.description }}
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<style scoped>

</style>
