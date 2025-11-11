<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SIDEBAR_OFFCANVAS_ID } from '@/constants/layout';
import type { BreadcrumbItemType } from '@/types';
import { Menu } from 'lucide-vue-next';

const props = withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItemType[];
        offcanvasId?: string;
    }>(),
    {
        breadcrumbs: () => [],
        offcanvasId: SIDEBAR_OFFCANVAS_ID,
    },
);
</script>

<template>
    <header
        class="d-flex align-items-center gap-3 border-bottom bg-body px-3 py-3 sticky-top"
    >
        <button
            type="button"
            class="btn btn-outline-secondary d-md-none"
            data-bs-toggle="offcanvas"
            :data-bs-target="`#${props.offcanvasId}`"
            :aria-controls="props.offcanvasId"
        >
            <Menu class="me-1" :size="18" />
            <span class="visually-hidden">Toggle sidebar</span>
        </button>
        <div class="flex-grow-1 overflow-hidden">
            <Breadcrumbs v-if="props.breadcrumbs.length" :breadcrumbs="props.breadcrumbs" />
        </div>
    </header>
</template>
