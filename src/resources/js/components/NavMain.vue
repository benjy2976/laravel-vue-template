<script setup lang="ts">
import { urlIsActive } from '@/lib/utils';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps<{
    items: NavItem[];
}>();

const page = usePage();

const isActive = (href: NavItem['href']) => href !== '#' && urlIsActive(href, page.url);
const hasChildren = (item: NavItem) => Array.isArray(item.children) && item.children.length > 0;
const isGroupActive = (item: NavItem) => item.children?.some(child => isActive(child.href)) ?? false;
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
                <template v-if="hasChildren(item)">
                    <div
                        class="d-flex align-items-center gap-2 px-3 py-2 small fw-semibold text-body-secondary"
                        :class="{ 'text-primary': isGroupActive(item) }"
                    >
                        <component
                            v-if="item.icon"
                            :is="item.icon"
                            class="opacity-75"
                            :size="16"
                        />
                        <span>{{ item.title }}</span>
                    </div>
                    <ul class="nav nav-pills flex-column gap-1 ms-3 mt-1">
                        <li
                            v-for="child in item.children"
                            :key="child.title"
                            class="nav-item"
                        >
                            <Link
                                :href="child.href"
                                class="nav-link d-flex align-items-center gap-2 py-2"
                                :class="{ active: isActive(child.href) }"
                            >
                                <component
                                    v-if="child.icon"
                                    :is="child.icon"
                                    class="opacity-75"
                                    :size="16"
                                />
                                <span>{{ child.title }}</span>
                            </Link>
                        </li>
                    </ul>
                </template>

                <Link
                    v-else
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
