<script setup>
defineProps({
  name: {
    type: String,
  },
  id: {
    type: String,
  },
  options: {
    type: Array,
    default: () => [],
  },
  modelValue: {
    type: String,
    required: true,
  },
  defaultLabel: {
    type: String,
  },
});

const emit = defineEmits(["update:modelValue"]);

const updateValue = (event) => {
  emit("update:modelValue", event.target.value);
};
</script>

<template>
  <select
    :name="name"
    :id="id"
    :value="modelValue"
    @change="updateValue"
    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
  >
    <option value="">{{ defaultLabel }}</option>
    <option v-for="(item, index) in options" :key="index" :value="item.id">
      {{ item.label }}
    </option>
  </select>
</template>
