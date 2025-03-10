<script setup>
import Button from "@/Components/Button.vue";
import DateInput from "@/Components/DateInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Select from "@/Components/Select.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
  categories: {
    type: Array,
    default: () => [],
  },
  transaction: {
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
  transaction_date: "",
  description: "",
  category_id: null,
  type: "income",
  amount: null,
});

const submit = () => (props.isUpdating ? editTransaction() : addTransaction());
const editTransaction = () =>
  form.put(route("transactions.update", props.transaction.id));
const addTransaction = () =>
  form.post(route("transactions.store"), {
    onSuccess: () => {
      form.reset();
    },
    onError: (errors) => {
      console.error(errors);
    },
  });
// const addTransaction = () => form.post("/transactions");
// const editTransaction = () => form.put(`/transactions/${props.transaction.id}`);

const categoryOptions = props.categories.map((category) => ({
  id: category.id,
  label: category.name,
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

onMounted(() => {
  if (props.transaction) {
    form.name = props.transaction.name;
    form.amount = props.transaction.amount;
    form.category_id = String(props.transaction.category_id);
    form.type = props.transaction.type;
    form.transaction_date = props.transaction.transaction_date;
    form.description = props.transaction.description;
  }
});
</script>

<template>
  <Head :title="isUpdating ? 'Edit Transaction' : 'Add Transaction'" />

  <AuthenticatedLayout>
    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
      >
        {{ isUpdating ? "Edit Transaction" : "Add Transaction" }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6"
        >
          <Link href="/transactions" class="text-gray-800 dark:text-gray-200"
            >&larr; Back</Link
          >
          <form @submit.prevent="submit" class="flex flex-col space-y-2 mt-10">
            <InputLabel value="Name" />
            <TextInput v-model="form.name" />
            <InputLabel value="Description" />
            <TextInput v-model="form.description" />
            <InputLabel value="Category" />
            <Select
              name="categoryId"
              id="categoryId"
              defaultLabel="Category"
              :options="categoryOptions"
              v-model="form.category_id"
            />
            <InputLabel value="Transaction Date" />
            <DateInput
              v-model="form.transaction_date"
              id="transaction_date"
              name="transaction_date"
            />
            <InputLabel value="Type" />
            <Select
              name="type"
              id="type"
              defaultLabel="Type"
              :options="typeOptions"
              v-model="form.type"
            />
            <InputLabel value="Amount" />
            <TextInput type="number" v-model="form.amount" />

            <Button class="!mt-8">
              {{ isUpdating ? 'Edit' : 'Submit' }}
            </Button>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
