<script setup lang="ts">
import type { CrudSearchPayload } from '@/components/crud/types';
import { router } from '@inertiajs/vue3';
import { Search, X } from 'lucide-vue-next';

const model = defineModel<string>({ default: '' });

const props = withDefaults(defineProps<CrudSearchPayload & {
  placeholder?: string;
}>(), {
  placeholder : 'Search',
  queryKey    : 'search',
});

const submit = () => {
  router.get(props.route, {
    [props.queryKey] : model.value || undefined,
  }, {
    preserveState : true,
    replace       : true,
  });
};

const clear = () => {
  model.value = '';
  submit();
};
</script>

<template>
  <form class="d-flex gap-2" role="search" @submit.prevent="submit">
    <input
      v-model="model"
      type="search"
      class="form-control"
      :placeholder="placeholder"
    />
    <button type="submit" class="btn btn-outline-secondary" title="Search">
      <Search :size="16" />
      <span class="visually-hidden">Search</span>
    </button>
    <button
      v-if="model"
      type="button"
      class="btn btn-outline-secondary"
      title="Clear search"
      @click="clear"
    >
      <X :size="16" />
      <span class="visually-hidden">Clear search</span>
    </button>
  </form>
</template>
