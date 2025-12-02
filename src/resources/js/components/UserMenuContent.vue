<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import { logout } from '@/routes';
import { edit } from '@/routes/profile';
import type { User } from '@/types';
import { Link, router } from '@inertiajs/vue3';
import { LogOut, Settings } from 'lucide-vue-next';

interface Props {
    user: User;
}

const handleLogout = () => {
  router.flushAll();
};

defineProps<Props>();
</script>

<template>
    <div class="px-3 py-2 border-bottom">
        <UserInfo :user="user" :show-email="true" />
    </div>
    <div class="py-1">
        <Link
            class="dropdown-item d-flex align-items-center gap-2"
            :href="edit()"
        >
            <Settings :size="16" />
            Settings
        </Link>
    </div>
    <div class="py-1 border-top">
        <Link
            class="dropdown-item d-flex align-items-center gap-2 text-danger"
            :href="logout()"
            data-test="logout-button"
            @click="handleLogout"
        >
            <LogOut :size="16" />
            Log out
        </Link>
    </div>
</template>
