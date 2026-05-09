<script setup lang="ts">
import AppToastViewport from '@/components/feedback/AppToastViewport.vue';
import AuthLayout from '@/layouts/auth/AuthSimpleLayout.vue';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <AuthLayout :title="title" :description="description">
        <slot ></slot>
    </AuthLayout>
    <AppToastViewport />
</template>
