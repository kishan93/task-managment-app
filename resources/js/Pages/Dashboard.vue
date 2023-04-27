<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref, useAttrs } from 'vue'
import type {Project} from "@/Types/project";

const attrs = useAttrs()
const user = ref(attrs.auth.user)

defineProps({
    'activeProject': Object as () => Project,
    'totalTasks': Number,
    'pendingTasks': Number,
    'inProgressTasks': Number,
    'completedTasks': Number,
})
</script>

<template>
    <AppLayout title="Dashboard">

        <template #header>
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">
                    Dashboard
                </h1>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-6 px-4">
                    <h2 class="text-2xl text-gray-700 pb-2">
                        Welcome {{user.name}}!
                    </h2>

                    <h3 class="text-xl pb-6" v-if="activeProject">
                        You are currently working on the project <span class="font-bold">{{activeProject.title}}</span>.
                    </h3>
                    <h3 class="text-xl pb-6" v-else>
                        You are currently browsing all projects.
                    </h3>

                    <p class="text-xl py-2 border-b border-t text-green-800">
                        You have completed {{completedTasks}} tasks.
                    </p>

                    <p class="text-xl py-2 border-b text-yellow-800">
                        You have {{pendingTasks}} pending tasks.
                    </p>

                    <p class="text-xl py-2 border-b text-blue-800">
                        You have {{inProgressTasks}} tasks in progress.
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
