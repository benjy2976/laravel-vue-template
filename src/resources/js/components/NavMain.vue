<script setup lang="ts">
import { urlIsActive } from '@/lib/utils';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps<{
    items: NavItem[];
}>();

const page = usePage();

const isActive = (href: NavItem['href']) => urlIsActive(href, page.url);
</script>

<template>
    <div class="mb-4">
        <p class="text-uppercase text-muted small mb-2">Platform</p>
        <ul class="nav nav-pills flex-column gap-2">
            <li
                v-for="item in props.items"
                :key="item.title"
                class="nav-item"
            >
                <Link
                    :href="item.href"
                    class="nav-link d-flex align-items-center gap-2"
                    :class="{ active: isActive(item.href) }"
                >
                    <component
                        v-if="item.icon"
                        :is="item.icon"
                        class="opacity-75"
                        :size="16"
                    />
                    <span>{{ item.title }}</span>
                </Link>
            </li>
        </ul>
    </div>
</template>
