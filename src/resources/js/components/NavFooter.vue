<script setup lang="ts">
import { toUrl } from '@/lib/utils';
import { type NavItem } from '@/types';

interface Props {
    items: NavItem[];
    class?: string;
}

const props = defineProps<Props>();
</script>

<template>
    <div :class="props.class">
        <ul class="list-unstyled mb-0">
            <li v-for="item in props.items" :key="item.title" class="mb-2">
                <a
                    class="d-flex align-items-center gap-2 text-decoration-none text-body-secondary"
                    :href="toUrl(item.href)"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <component
                        v-if="item.icon"
                        :is="item.icon"
                        class="opacity-75"
                        :size="16"
                    />
                    <span>{{ item.title }}</span>
                </a>
            </li>
        </ul>
    </div>
</template>
