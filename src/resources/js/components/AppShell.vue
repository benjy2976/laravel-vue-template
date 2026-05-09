<script setup lang="ts">
import AppToastViewport from '@/components/feedback/AppToastViewport.vue';

interface Props {
    variant?: 'header' | 'sidebar';
}

withDefaults(defineProps<Props>(), {
  variant : 'header',
});
</script>

<template>
    <div
        v-if="variant === 'header'"
        class="d-flex min-vh-100 w-100 flex-column bg-body"
    >
        <slot ></slot>
        <AppToastViewport />
    </div>
    <div
        v-else
        class="d-flex vh-100 w-100 flex-row bg-body-secondary overflow-hidden"
    >
        <slot ></slot>
        <AppToastViewport />
    </div>
</template>
