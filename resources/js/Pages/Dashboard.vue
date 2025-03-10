<script setup>
import LineChart from "@/Components/LineChart.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = defineProps({
  transactions: {
    type: Array,
    default: () => [],
  },
  totalIncome: {
    type: Number,
  },
  totalExpense: {
    type: Number,
  },
  dailyTransactions: {
    type: Array,
    default: () => [],
  },
});

const lastData = props.dailyTransactions.slice(0, 30);
const filteredData = lastData.map((item) => item.date);
const labels = filteredData.sort();
const incomeData = lastData.map((item) => item.income)
const expenseData = lastData.map((item) => item.expense);
console.log(incomeData)
// console.log(incomeData)

const formatCurrency = (value) => {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 2,
  }).format(value);
};

const balance = props.totalIncome - props.totalExpense;

const lineRef = ref();

const chartData = computed(() => ({
  labels: labels,
  datasets: [
    {
      label: "Income",
      borderColor: "rgba(54, 162, 235, 1)",
      backgroundColor: "rgba(54, 162, 235, 0.2)",
      data: incomeData,
      fill: true,
    },
    {
      label: "Expense",
      borderColor: "rgba(255, 99, 132, 1)",
      backgroundColor: "rgba(255, 99, 132, 0.2)",
      data: expenseData,
      fill: true,
    },
  ],
}));

const chartOptions = ref({
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      display: true,
      position: "top",
    },
  },
  // scales: {
  //   y: {
  //     min: 0,
  //     max: 2000000,
  //     ticks: {
  //       stepSize: 100000
  //     }
  //   }
  // }
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
      >
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
        >
          <p class="text-gray-900 dark:text-gray-100">
            Welcome, {{ $page.props.auth.user.name }}
          </p>

          <p class="text-gray-900 dark:text-gray-100 mt-3">
            This is recap your finances in the last months
          </p>
          <div class="flex items-center mt-7 mb-10">
            <div class="flex-1 text-center">
              <h2 class="text-gray-900 dark:text-gray-100">Income</h2>
              <p class="text-red-500">{{ formatCurrency(totalIncome) }}</p>
            </div>
            <div class="flex-1 text-center">
              <h2 class="text-gray-900 dark:text-gray-100">Expense</h2>
              <p class="text-green-500">{{ formatCurrency(totalExpense) }}</p>
            </div>
            <div class="flex-1 text-center">
              <h2 class="text-gray-900 dark:text-gray-100">Balance</h2>
              <p class="text-blue-500">{{ formatCurrency(balance) }}</p>
            </div>
          </div>
          <div>
            <LineChart
              ref="lineRef"
              :data="chartData"
              :options="chartOptions"
            />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
