<script setup lang="ts">
import type { CrudColumn } from '@/components/crud/types';

const props = withDefaults(defineProps<{
  columns: CrudColumn[];
  rows: unknown[];
  rowKey?: string;
  emptyMessage?: string;
}>(), {
  emptyMessage : 'No records found.',
  rowKey       : 'id',
});

defineSlots<{
  [name: `cell-${string}`]: (props: {
    column: CrudColumn;
    row: any;
    value: unknown;
  }) => any;
  actions?: (props: { row: any }) => any;
}>();

const readValue = (row: unknown, key: string) => {
  if (!row || typeof row !== 'object') {
    return '';
  }

  return (row as Record<string, unknown>)[key] ?? '';
};

const resolveRowKey = (row: unknown, index: number) => {
  const value = readValue(row, props.rowKey);

  return typeof value === 'string' || typeof value === 'number'
    ? value
    : index;
};
</script>

<template>
  <div class="table-responsive">
    <table class="table align-middle app-data-table">
      <thead>
        <tr>
          <th
            v-for="column in columns"
            :key="column.key"
            :class="column.headerClass"
          >
            {{ column.label }}
          </th>
          <th v-if="$slots.actions" class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(row, index) in rows"
          :key="resolveRowKey(row, index)"
        >
          <td
            v-for="column in columns"
            :key="column.key"
            :class="column.cellClass"
          >
            <slot
              :name="`cell-${column.key}`"
              :row="row"
              :value="readValue(row, column.key)"
              :column="column"
            >
              {{ readValue(row, column.key) }}
            </slot>
          </td>
          <td v-if="$slots.actions" class="text-end">
            <slot name="actions" :row="row" ></slot>
          </td>
        </tr>
        <tr v-if="!rows.length">
          <td
            :colspan="columns.length + ($slots.actions ? 1 : 0)"
            class="text-center text-muted py-4"
          >
            <div class="app-empty-state d-flex align-items-center justify-content-center">
              {{ emptyMessage }}
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
