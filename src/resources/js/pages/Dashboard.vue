<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title : 'Dashboard',
    href  : dashboard().url,
  },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="d-flex flex-column flex-grow-1 gap-4 overflow-auto rounded-4 p-4">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="ratio ratio-16x9 position-relative overflow-hidden rounded-4 border border-secondary-subtle">
                        <PlaceholderPattern />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ratio ratio-16x9 position-relative overflow-hidden rounded-4 border border-secondary-subtle">
                        <PlaceholderPattern />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ratio ratio-16x9 position-relative overflow-hidden rounded-4 border border-secondary-subtle">
                        <PlaceholderPattern />
                    </div>
                </div>
            </div>
            <div class="position-relative flex-grow-1 rounded-4 border border-secondary-subtle min-vh-100">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
