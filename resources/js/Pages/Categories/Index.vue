<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const props = defineProps({
  categories: {
    type: Array,
    default: () => [],
  },
});

const tableHeaders = ["#", "Name", "Description"];
const deleteItem = (id) => {
  if (!window.confirm("Are you sure want to delete this category?")) {
    return;
  }

  router.delete(route("categories.destroy", id))
};
</script>

<template>
  <Head title="Categories" />

  <AuthenticatedLayout>
    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
      >
        Categories
      </h2>
    </template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
      <div
        class="bg-white dark:bg-gray-800 p-6 overflow-hidden shadow-sm sm:rounded-lg"
      >
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-gray-800 dark:text-gray-100">Categories List</h2>
          <Link
            href="categories/create"
            class="underline text-gray-800 dark:text-gray-100"
            >Add Category</Link
          >
        </div>

        <table
          class="table-auto border-collapse border border-gray-300 w-full text-gray-800 dark:text-gray-100"
        >
          <thead>
            <tr>
              <th
                v-for="(header, index) in tableHeaders"
                :key="index"
                class="border border-gray-300 py-2"
              >
                {{ header }}
              </th>
              <th class="border border-gray-300 py-2">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in categories" :key="index">
              <td class="border p-2">{{ row.id }}</td>
              <td class="border p-2">{{ row.name }}</td>
              <td class="border p-2">{{ row.description }}</td>
              <td class="border p-2">
                <div class="flex items-center gap-x-3">
                  <Link
                    :href="`categories/${row.id}/edit`"
                    class="font-semibold text-blue-500"
                    >Edit</Link
                  >
                  <!-- <button
                    @click="deleteItem(row.id)"
                    class="font-semibold text-red-500"
                  >
                    Delete
                  </button> -->
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
