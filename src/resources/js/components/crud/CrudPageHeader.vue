<script setup lang="ts">
defineProps<{
  title: string;
  description?: string;
}>();
</script>

<template>
  <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
    <div>
      <h1 class="h3 mb-1">{{ title }}</h1>
      <p v-if="description" class="text-muted mb-0">
        {{ description }}
      </p>
    </div>

    <div v-if="$slots.actions" class="d-flex align-items-start gap-2">
      <slot name="actions" ></slot>
    </div>
  </div>
</template>
