<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link, useForm} from "@inertiajs/vue3";
import type {Task} from "@/js/Types/task";
import draggable from "vuedraggable";
import KanBanBoard from "@/Components/Task/KanBanBoard.vue";

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

                <KanBanBoard :tasks="tasks"/>

            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
