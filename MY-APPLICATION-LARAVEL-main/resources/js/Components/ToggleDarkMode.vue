<script setup>
import { ref, onMounted, defineExpose } from "vue";

// Dark mode state
const isDarkMode = ref(localStorage.getItem("darkMode") === "true" || false);

// Toggle dark mode
const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    document.documentElement.classList.toggle("my-app-dark", isDarkMode.value);
    localStorage.setItem("darkMode", isDarkMode.value);
};

// Expose methods and properties to parent components
defineExpose({
  toggleDarkMode,
  isDarkMode
});
</script>

<template>
  <Button 
    :icon="isDarkMode ? 'pi pi-sun' : 'pi pi-moon'" 
    class="p-button-rounded p-button-text z-40"
    severity="contrast"
    @click="toggleDarkMode"
  />
</template>
