<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>
<template>
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-5 bg-body">
        <div class="w-100" style="max-width: 420px">
            <div class="text-center mb-4">
                <Link :href="home()" class="d-inline-flex align-items-center justify-content-center mb-3">
                    <AppLogoIcon class="text-primary" :size="48" />
                </Link>
                <h1 class="h4 mb-2">{{ title }}</h1>
                <p class="text-muted small mb-0">
                    {{ description }}
                </p>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
