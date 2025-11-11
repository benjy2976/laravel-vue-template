<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance';
import { Monitor, Moon, Sun } from 'lucide-vue-next';

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
] as const;
</script>

<template>
    <div class="btn-group p-1 rounded-pill bg-body-secondary-subtle" role="group">
        <button
            v-for="{ value, Icon, label } in tabs"
            :key="value"
            type="button"
            class="btn btn-sm d-flex align-items-center gap-2 px-3 appearance-tab"
            :class="appearance === value ? 'btn-primary text-white' : 'btn-outline-secondary text-body'"
            @click="updateAppearance(value)"
        >
            <component :is="Icon" :size="16" class="opacity-75" />
            <span class="fw-medium">{{ label }}</span>
        </button>
    </div>
</template>
