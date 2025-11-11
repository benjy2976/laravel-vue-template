<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { usePage } from '@inertiajs/vue3';
import { ChevronsUpDown } from 'lucide-vue-next';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <div class="dropdown w-100">
        <button
            class="btn btn-outline-secondary d-flex align-items-center w-100"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            <UserInfo :user="user" />
            <ChevronsUpDown class="ms-auto" :size="16" />
        </button>
        <div class="dropdown-menu dropdown-menu-end w-100 shadow">
            <UserMenuContent :user="user" />
        </div>
    </div>
</template>
