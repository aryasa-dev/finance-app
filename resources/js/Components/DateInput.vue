<script setup>
const props = defineProps({
  name: {
    type: String,
  },
  id: {
    type: String,
  },
  modelValue: {
    type: String,
    required: true,
  },
});

const emit = defineEmits(["update:modelValue"]);

const updateValue = (event) => {
  emit("update:modelValue", event.target.value);
};
</script>

<template>
  <input
    type="date"
    :name="name"
    :id="id"
    :value="modelValue"
    @change="updateValue"
    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
  />
</template>
