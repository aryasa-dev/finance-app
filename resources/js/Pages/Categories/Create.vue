<script setup>
import Button from "@/Components/Button.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
  category: {
    type: Object,
    default: null,
  },
  isUpdating: {
    type: Boolean,
    default: false,
  },
});

const form = useForm({
  name: "",
  description: "",
});

const submit = () => (props.isUpdating ? editCategory() : addCategory());
const addCategory = () => form.post(route("categories.store"), {
  onSuccess: () => {
    form.reset()
  },
  onError: (errors) => {
    console.error(errors)
  }
})
const editCategory = () => form.put(route("categories.update", props.category.id));

onMounted(() => {
  if (props.category) {
    form.name = props.category.name;
    form.description = props.category.description;
  }
});
</script>

<template>
  <Head :title="isUpdating ? 'Edit Category' : 'Add Category'" />

  <AuthenticatedLayout>
    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
      >
        {{ isUpdating ? "Edit Category" : "Add Category" }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6"
        >
          <Link href="/categories" class="text-gray-800 dark:text-gray-200"
            >&larr; Back</Link
          >
          <form @submit.prevent="submit" class="flex flex-col space-y-2 mt-10">
            <InputLabel value="Name" />
            <TextInput v-model="form.name" />
            <InputLabel value="Description" />
            <TextInput v-model="form.description" />

            <Button class="!mt-8">
              {{ isUpdating ? 'Edit' : 'Submit' }}
            </Button>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
