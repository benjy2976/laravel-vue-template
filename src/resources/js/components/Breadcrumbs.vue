<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

interface BreadcrumbItemType {
    title: string;
    href?: string;
}

defineProps<{
    breadcrumbs: BreadcrumbItemType[];
}>();
</script>

<template>
    <nav aria-label="Breadcrumb">
        <ol class="breadcrumb mb-0">
            <li
                v-for="(item, index) in breadcrumbs"
                :key="`${item.title}-${index}`"
                class="breadcrumb-item"
                :class="{ active: index === breadcrumbs.length - 1 }"
                :aria-current="index === breadcrumbs.length - 1 ? 'page' : undefined"
            >
                <template v-if="index === breadcrumbs.length - 1">
                    {{ item.title }}
                </template>
                <template v-else>
                    <Link :href="item.href ?? '#'">
                        {{ item.title }}
                    </Link>
                </template>
            </li>
        </ol>
    </nav>
</template>
