<script setup>
import {
  CategoryScale,
  Chart as ChartJS,
  Legend,
  LinearScale,
  LineElement,
  PointElement,
  // registerables,
  Title,
  Tooltip,
} from "chart.js";
import { Line } from "vue-chartjs";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
  // ...registerables
);

const props = defineProps({
  data: Object,
  options: Object,
});
</script>

<template>
  <Line :data="data" :options="options" class="h-[300px]" />
</template>
