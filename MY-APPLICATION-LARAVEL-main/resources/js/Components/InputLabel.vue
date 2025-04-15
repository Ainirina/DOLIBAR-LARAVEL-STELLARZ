<script setup>
defineProps(['value']);
</script>

<template>
    <label for="in_label" class="z-40">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
