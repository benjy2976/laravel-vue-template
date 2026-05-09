import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

import type { AppPageProps } from '@/types';

export function useAuthorization() {
  const page = usePage<AppPageProps>();

  const permissions = computed(() => page.props.auth.permissions ?? []);
  const roles = computed(() => page.props.auth.roles ?? []);

  const can = (permission: string) => permissions.value.includes(permission);
  const hasRole = (role: string) => roles.value.includes(role);

  return {
    can,
    hasRole,
    permissions,
    roles,
  };
}
