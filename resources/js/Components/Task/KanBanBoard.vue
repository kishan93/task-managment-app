<template>
  <div class="grid grid-cols-12">

    <div class="col-span-4">
      <TaskList group="tasks" heading="Pending" v-model="pendingTasks" item-key="id" :status="null" />
    </div>

    <div class="col-span-4">
      <TaskList group="tasks" heading="In progress" v-model="inProgressTasks" item-key="id" status="in progress" />
    </div>

    <div class="col-span-4">
      <TaskList group="tasks" heading="Completed" v-model="completedTasks" item-key="id" status="completed" />
    </div>

  </div>
</template>

<script setup>
import {ref} from 'vue'
import TaskList from './TaskList.vue'

const props = defineProps({
  tasks: Array,
})

const pendingTasks = ref(props.tasks.filter(t => t.status == null))
const inProgressTasks = ref(props.tasks.filter(t => t.status === 'in progress'))
const completedTasks = ref(props.tasks.filter(t => t.status === 'completed'))

</script>

<style scoped>

</style>
