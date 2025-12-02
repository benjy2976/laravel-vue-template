<script setup lang="ts">
interface Props {
    variant?: 'header' | 'sidebar';
    class?: string;
}

const props = withDefaults(defineProps<Props>(), {
  variant : 'header',
  class   : '',
});
</script>

<template>
    <div
        v-if="props.variant === 'sidebar'"
        class="d-flex flex-column flex-grow-1 overflow-auto bg-body vh-100"
        :class="props.class"
    >
        <slot ></slot>
    </div>
    <main
        v-else
        class="container py-4 flex-grow-1 d-flex flex-column"
        :class="props.class"
    >
        <slot ></slot>
    </main>
</template>
