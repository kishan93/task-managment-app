<template>
  <div class='h-full bg-white shadow-lg rounded-lg m-6'>
    <div class="w-full bg-gray-200 rounded-t-lg py-2 text-center">
      <h3>{{ heading }}</h3>
    </div>
    <Draggable
      v-model="tasks"
      class="h-full"
      :group="group"
      :item-key="itemKey"
      @change="handleChange"
    >
      <template #item="{element}">
        <TaskCard :task="element"/>
      </template>

    </Draggable>
  </div>
</template>

<script setup>
import { computed, ref, watch } from 'vue'
import Draggable from 'vuedraggable'
import TaskCard from './TaskCard.vue'

const props = defineProps({
  heading: String,
  group: String,
  itemKey: String,
  status: {},
  modelValue: Array,
})
const emit = defineEmits(['update:modalValue'])

const tasks = ref([...props.modelValue])

const updateValue = () => {
  emit('update:modalValue', props.tasks)
}

watch(tasks, updateValue)


const handleChange = (event) => {
  console.log(`changed event in ${props.status}`)
  console.log(event)
  // added or moved
  if (!event.added && !event.moved) {
    return
  }

  let newIndex = 0
  let element = {}

  if (event.added) {
    newIndex = event.added.newIndex
    element = event.added.element
    // update status
    element.status = props.status
  } else if (event.moved) {
    newIndex = event.moved.newIndex
    element = event.moved.element
  }

  // calculate priority
  const maxIndex = tasks.value.length - 1
  let minPriority = 0
  let maxPriority = element.id

  if (maxIndex===0) {
    element.priority = element.id
  } else {
    if (newIndex === maxIndex) {
      minPriority = tasks.value[newIndex - 1].priority
      maxPriority = minPriority + 1
    } else if (newIndex === 0) {
      maxPriority = tasks.value[newIndex + 1].priority
      minPriority = maxPriority - 1
    }  else {
      maxPriority = tasks.value[newIndex + 1].priority
      minPriority = tasks.value[newIndex - 1].priority
    }

    element.priority = (minPriority + maxPriority) / 2
  }

  axios.patch(route('tasks.update', element.id), element, {
    preserveScroll: true,
  })

  tasks.value[newIndex] = { ...element }

}

</script>

<style scoped>

</style>
