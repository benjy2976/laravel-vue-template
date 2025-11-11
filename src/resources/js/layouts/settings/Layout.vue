<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { urlIsActive } from '@/lib/utils';
import { edit as editAppearance } from '@/routes/appearance';
import { edit as editProfile } from '@/routes/profile';
import { show } from '@/routes/two-factor';
import { edit as editPassword } from '@/routes/user-password';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: editProfile(),
    },
    {
        title: 'Password',
        href: editPassword(),
    },
    {
        title: 'Two-Factor Auth',
        href: show(),
    },
    {
        title: 'Appearance',
        href: editAppearance(),
    },
];

const page = usePage();
const currentPath = computed(() => page.url);
</script>

<template>
    <div class="py-4 px-3 px-lg-4">
        <Heading
            title="Settings"
            description="Manage your profile and account settings"
        />

        <div class="row mt-4">
            <aside class="col-lg-3 mb-4">
                <nav class="nav nav-pills flex-column gap-2">
                    <Link
                        v-for="item in sidebarNavItems"
                        :key="item.title"
                        class="nav-link"
                        :class="{ active: urlIsActive(item.href, currentPath) }"
                        :href="item.href"
                    >
                        {{ item.title }}
                    </Link>
                </nav>
            </aside>

            <div class="col-lg-9">
                <section class="vstack gap-5">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>
