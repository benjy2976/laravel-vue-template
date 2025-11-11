<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import AppLogo from '@/components/AppLogo.vue';
import { SIDEBAR_OFFCANVAS_ID, SIDEBAR_WIDTH } from '@/constants/layout';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { BookOpen, Folder, LayoutGrid } from 'lucide-vue-next';

const props = withDefaults(
    defineProps<{
        offcanvasId?: string;
    }>(),
    {
        offcanvasId: SIDEBAR_OFFCANVAS_ID,
    },
);

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <aside
        class="d-none d-md-flex flex-column border-end bg-body app-sidebar vh-100 overflow-auto"
        :style="`width: ${SIDEBAR_WIDTH}px`"
    >
        <div class="border-bottom p-4">
            <AppLogo />
        </div>
        <div class="flex-grow-1 overflow-auto px-3 py-4">
            <NavMain :items="mainNavItems" />
        </div>
        <div class="border-top p-3">
            <NavFooter :items="footerNavItems" />
            <NavUser class="mt-3" />
        </div>
    </aside>

    <div
        class="offcanvas offcanvas-start"
        tabindex="-1"
        :id="props.offcanvasId"
        :aria-labelledby="`${props.offcanvasId}-label`"
    >
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title mb-0" :id="`${props.offcanvasId}-label`">
                <AppLogo />
            </h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            ></button>
        </div>
        <div class="offcanvas-body d-flex flex-column p-0 bg-body app-sidebar">
            <div class="border-bottom p-3">
                <NavMain :items="mainNavItems" />
            </div>
            <div class="mt-auto border-top p-3">
                <NavFooter :items="footerNavItems" />
                <NavUser class="mt-3" />
            </div>
        </div>
    </div>
</template>
