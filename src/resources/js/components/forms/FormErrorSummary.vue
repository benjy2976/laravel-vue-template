<script setup lang="ts">
import AlertError from '@/components/AlertError.vue';
import { flattenFormErrors } from '@/composables/useFormErrors';
import type { FormErrors } from '@/types';
import { computed } from 'vue';

const props = withDefaults(defineProps<{
  errors?: FormErrors;
  title?: string;
}>(), {
  errors : () => ({}),
  title  : 'Please review the highlighted fields.',
});

const messages = computed(() => flattenFormErrors(props.errors));
</script>

<template>
  <AlertError
    v-if="messages.length"
    :errors="messages"
    :title="title"
  />
</template>
