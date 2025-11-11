<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import { SIDEBAR_OFFCANVAS_ID } from '@/constants/layout';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell variant="sidebar">
        <AppSidebar :offcanvas-id="SIDEBAR_OFFCANVAS_ID" />
        <AppContent variant="sidebar" class="position-relative d-flex flex-column">
            <AppSidebarHeader
                :breadcrumbs="breadcrumbs"
                :offcanvas-id="SIDEBAR_OFFCANVAS_ID"
            />
            <div class="flex-grow-1 p-4">
                <slot />
            </div>
        </AppContent>
    </AppShell>
</template>
