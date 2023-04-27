<script setup lang="ts">
import {ref} from 'vue'
import TaskList from './TaskList.vue'
import type {Task} from "@/Types/task";

const props = defineProps({
    tasks: Array as () => Task[],
})

const pendingTasks = ref(props.tasks.filter(t => t.status == null || t.status === 'todo'))
const inProgressTasks = ref(props.tasks.filter(t => t.status === 'in_progress'))
const completedTasks = ref(props.tasks.filter(t => t.status === 'done'))

</script>
<template>
  <div class="grid grid-cols-12">

    <div class="col-span-4">
      <TaskList group="tasks" heading="Todo" v-model="pendingTasks" item-key="id" status="todo" />
    </div>

    <div class="col-span-4">
      <TaskList group="tasks" heading="In progress" v-model="inProgressTasks" item-key="id" status="in_progress" />
    </div>

    <div class="col-span-4">
      <TaskList group="tasks" heading="Done" v-model="completedTasks" item-key="id" status="done" />
    </div>

  </div>
</template>


<style scoped>

</style>
