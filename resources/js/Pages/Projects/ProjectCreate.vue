<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import AppLayout from "@/Layouts/AppLayout.vue"
import ProjectForm from "@/Components/Forms/ProjectForm.vue"
import {Link} from "@inertiajs/vue3"

const form = useForm({
    title: '',
    description: '',
})

</script>

<template>
  <AppLayout title="Create Project">
    <template #header>
      <div class="flex justify-between">
        <h1 class="text-2xl font-bold">
          Create Project
        </h1>
        <Link
          :href="route('projects.index')"
          class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
        >
          Back
        </Link>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-6 px-8 my-4">
          <ProjectForm />
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>

</style>
