<script setup>
import DateInput from "@/Components/DateInput.vue";
import Pagination from "@/Components/Pagination.vue";
import Select from "@/Components/Select.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
  transactions: {
    type: Array,
    default: () => [],
  },
  categories: {
    type: Array,
    default: () => [],
  },
  queryParams: {
    type: Object,
    default: () => ({}),
  },
});
const tableHeaders = [
  "No",
  "Name",
  "Description",
  "Type",
  "Category",
  "Transaction Date",
  "Amount",
];
const deleteItem = async (id) => {
  if (!window.confirm("Are you sure want to delete this transaction?")) {
    return;
  }

  router.delete(route("transactions.destroy", id), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      alert("Transaction deleted successfully!");
    },
    onError: (error) => {
      console.error("Failed to delete transaction:", error);
      alert("Failed to delete transaction. Please try again.");
    },
  });
};

const queryParams = ref({ ...props.queryParams });
const selectedCategory = ref(queryParams.value.category);
const selectedType = ref(queryParams.value.type);
const queryStartDate = ref(queryParams.value.start_date);
const queryEndDate = ref(queryParams.value.end_date);

const categoryOptions = props.categories.map((category) => ({
  id: category.name,
  label: category.name.charAt(0).toUpperCase() + category.name.slice(1),
}));

const typeOptions = [
  {
    id: "income",
    label: "Income",
  },
  {
    id: "expense",
    label: "Expense",
  },
];

watch(
  () => props.queryParams,
  (newparams) => {
    queryParams.value = { ...newparams };
  },
  { deep: true }
);

const searchFieldChanged = (name, value) => {
  console.log(queryParams.value, "qwqaa");
  console.log(value, "vaa");
  if (value) {
    queryParams.value = { ...queryParams.value, [name]: value };
  } else {
    const newQueryParams = { ...queryParams.value };
    delete newQueryParams[name];
    queryParams.value = newQueryParams;
  }

  router.get(route("transactions.index"), queryParams.value);
};

const sortableFields = {
  "No": "id",
  "Transaction Date": "transaction_date",
  "Amount": "amount"
}

const getField = (header) => sortableFields[header] || null

const isSortable = (header) => !!getField(header)

const sortChanged = (name) => {
  if (name === queryParams.value.sort_field) {
    queryParams.value.sort_direction =
      queryParams.value.sort_direction === "asc" ? "desc" : "asc";
  } else {
    queryParams.value.sort_field = name;
    queryParams.value.sort_direction = "asc";
  }

  router.get(route("transactions.index"), { ...queryParams.value });
};
</script>

<template>
  <Head title="Transactions" />

  <AuthenticatedLayout>
    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
      >
        Transactions
      </h2>
    </template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10 !pb-20">
      <div
        class="bg-white dark:bg-gray-800 p-6 overflow-hidden shadow-sm sm:rounded-lg"
      >
        <div class="flex items-center justify-between mb-5">
          <div class="flex gap-x-5 items-center">
            <Select
              v-model="selectedType"
              defaultLabel="Type"
              :options="typeOptions"
              name="typeSelect"
              id="typeSelect"
              @update:modelValue="(value) => searchFieldChanged('type', value)"
            />
            <Select
              v-model="selectedCategory"
              defaultLabel="Category"
              :options="categoryOptions"
              name="categorySelect"
              id="categorySelect"
              @update:modelValue="
                (value) => searchFieldChanged('category', value)
              "
            />
            <DateInput
              id="start_date"
              name="start_date"
              v-model="queryStartDate"
              @change="
                (event) => searchFieldChanged('start_date', event.target.value)
              "
            />
            <DateInput
              name="end_date"
              id="end_date"
              :value="queryEndDate"
              @change="
                (event) => searchFieldChanged('end_date', event.target.value)
              "
            />
          </div>
          <Link
            href="transactions/create"
            class="text-gray-800 dark:text-gray-200 underline"
            >Add Transaction</Link
          >
        </div>

        <div class="w-full overflow-x-auto">
          <table
            class="table-auto whitespace-nowrap border-collapse border border-gray-300 w-full text-gray-800 dark:text-gray-100"
          >
            <thead>
              <tr>
                <th
                  v-for="(header, index) in tableHeaders"
                  :key="index"
                  class="border border-gray-300 p-2 cursor-pointer"
                  @click="isSortable(header) && sortChanged(getField(header))"
                >
                  <div class="flex items-center gap-x-1">
                    <span>{{ header }}</span>
                    <span v-if="queryParams.sort_field === getField(header)">
                      <span v-if="queryParams.sort_direction === 'asc'">▲</span>
                      <span v-else>▼</span>
                    </span>
                  </div>
                </th>
                <th class="border border-gray-300 py-2">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-if="transactions.data.length > 0"
                v-for="(row, index) in transactions.data"
                :key="index"
              >
                <td class="border p-2">{{ row.id }}</td>
                <td class="border p-2">{{ row.name }}</td>
                <td class="border p-2">{{ row.description }}</td>
                <td class="border p-2">
                  <span
                    :class="`px-2 py-1 rounded-lg ${
                      row.type === 'expense'
                        ? 'bg-red-500 text-white'
                        : 'bg-green-500 text-white'
                    }`"
                    >{{ row.type }}</span
                  >
                </td>
                <td class="border p-2">{{ row.category.name }}</td>
                <td class="border p-2">{{ row.transaction_date }}</td>
                <td class="border p-2">{{ row.amount }}</td>
                <td class="border p-2">
                  <div class="flex items-center gap-x-3">
                    <Link
                      :href="route('transactions.edit', row.id)"
                      class="font-semibold text-blue-500"
                      >Edit</Link
                    >
                    <button
                      @click="deleteItem(row.id)"
                      class="font-semibold text-red-500"
                    >
                      Delete
                    </button>
                  </div>
                </td>
              </tr>

              <tr v-else>
                <td>
                  <p class="py-2 text-center">There is nothing to show.</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <Pagination :meta="transactions.meta" />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
