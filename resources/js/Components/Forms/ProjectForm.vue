<script setup lang="ts">
import type {Project} from "@/Types/project";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    project: {
        type: Object as Project,
        required: false,
        default: () => {
            return {
                title: '',
                description: '',
            }
        }
    },
})

const form = useForm({
    ...props.project,
})

const onSubmit = () => {
    if (props.project.id) {
        form.put(route('projects.update', props.project.id))
    } else {
        form.post(route('projects.store'))
    }
}
</script>

<template>
    <form @submit.prevent="onSubmit">
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
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ form.proccessing ? 'Saving...' : 'Save'}}
            </button>

            <span class="py-2 text-gray-500" v-if="form.recentlySuccessful">
                Saved.
            </span>
        </div>
    </form>
</template>

<style scoped>

</style>
