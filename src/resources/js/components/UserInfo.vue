<script setup lang="ts">
import { useInitials } from '@/composables/useInitials';
import type { User } from '@/types';
import { computed } from 'vue';

interface Props {
    user: User;
    showEmail?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    showEmail: false,
});

const { getInitials } = useInitials();

const hasAvatar = computed(
    () => Boolean(props.user.avatar && props.user.avatar !== ''),
);
</script>

<template>
    <div class="d-flex align-items-center gap-2 w-100">
        <div
            class="rounded-circle bg-secondary-subtle text-secondary-emphasis d-flex align-items-center justify-content-center overflow-hidden flex-shrink-0"
            style="width: 40px; height: 40px"
        >
            <img
                v-if="hasAvatar"
                :src="user.avatar!"
                :alt="user.name"
                class="img-fluid w-100 h-100 object-fit-cover"
            />
            <span v-else class="fw-semibold">
                {{ getInitials(user.name) }}
            </span>
        </div>
        <div class="d-flex flex-column overflow-hidden text-start">
            <span class="fw-semibold text-truncate">{{ user.name }}</span>
            <small
                v-if="showEmail"
                class="text-muted text-truncate"
            >
                {{ user.email }}
            </small>
        </div>
    </div>
</template>
