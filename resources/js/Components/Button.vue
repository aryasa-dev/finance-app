<script setup>
import { computed } from 'vue';


const props = defineProps({
    variant: {
      type: String,
      default: "primary"
    },
    size: {
      type: String,
      default: "default"
    },
    label: {
      type: String
    },
    isDisabled: {
      type: Boolean,
      default: false
    }
})

const primaryClass =
  "bg-gray-800 dark:bg-gray-200 border-transparent text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:ring-2";

const secondaryClass =
  "bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-2 disabled:opacity-25";

const baseClass =
  "inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 focus:outline-none focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:cursor-not-allowed";

const variant = computed(() => {
    switch (props.variant) {
      case "secondary":
        return secondaryClass
      default:
        return primaryClass
    }
})

const size = computed(() => {
  switch (props.size) {
    case "large":
      return "w-full"
    default:
      return "w-fit"
  }
})
</script>

<template>
  <button 
    :class="[
      baseClass,
      variant,
      size,
      { 'cursor-not-allowed' : isDisabled }
    ]"
    :disabled="isDisabled"
  >
    <slot></slot>
  </button>
</template>
