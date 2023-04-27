<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";
import type {Task} from "@/Types/task";

const props = defineProps({
    task: {
        type: Object as Task,
        required: false,
        default: () => {
            return {
                title: '',
                description: '',
                priority: '',
                status: '',
            }
        }
    },
})

const form = useForm({
    ...props.task,
})

const onSubmit = () => {
    if (props.task.id) {
        form.put(route('tasks.update', props.task.id))
    } else {
        form.post(route('tasks.store'))
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
        <div class="mb-4">
            <label for="status" class="sr-only">Status</label>
            <select id="status" v-model="form.status" :class="{ 'border-red-500': form.status.error }" class="bg-gray-100 border-2 w-full p-4 rounded-lg">
                <option value="">Select Status</option>
                <option value="todo">To Do</option>
                <option value="in_progress">In Progress</option>
                <option value="done">Done</option>
            </select>
            <div class="text-red-500 mt-2" v-if="form.status.error">
                {{ form.errors.status }}
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
