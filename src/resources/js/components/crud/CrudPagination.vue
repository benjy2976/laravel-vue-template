<script setup lang="ts">
import type { CrudPaginationLink } from '@/components/crud/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
  links: CrudPaginationLink[];
  label?: string;
}>();

const normalizedLabel = (label: string) => label
  .replace('&laquo;', '')
  .replace('&raquo;', '')
  .trim();
</script>

<template>
  <nav
    v-if="links.length > 3"
    :aria-label="label || 'Pagination'"
  >
    <ul class="pagination mb-0">
      <li
        v-for="link in links"
        :key="link.label"
        class="page-item"
        :class="{ active: link.active, disabled: !link.url }"
      >
        <Link
          class="page-link"
          :href="link.url || '#'"
          preserve-scroll
        >
          {{ normalizedLabel(link.label) }}
        </Link>
      </li>
    </ul>
  </nav>
</template>
