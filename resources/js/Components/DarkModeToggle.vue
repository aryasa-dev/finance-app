<script setup>
import { ref } from "vue";

const isDarkMode = ref(false);

const checkDarkMode = () => {
    if (localStorage.getItem("dark_mode") === "true") {
        document.body.classList.add("dark");
        isDarkMode.value = true;
    }
};

checkDarkMode();

const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    if (isDarkMode.value) {
        document.body.classList.add("dark");
        localStorage.setItem("dark_mode", "true");
    } else {
        document.body.classList.remove("dark");
        localStorage.setItem("dark_mode", "false");
    }
};
</script>

<template>
    <div
        @click="toggleDarkMode"
        class="p-2 rounded cursor-default bg-gray-800 text-white"
    >
        {{ isDarkMode ? "Light Mode" : "Dark Mode" }}
    </div>
</template>
