<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>

<template>
    <p v-if="message" class="text-danger small mt-1 mb-0">
        {{ message }}
    </p>
</template>
