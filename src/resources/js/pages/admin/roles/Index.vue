<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { useAuthorization } from '@/composables/useAuthorization';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface PermissionOption {
  id: number;
  name: string;
  label: string | null;
  description: string | null;
}

interface RoleRow {
  id: number;
  name: string;
  label: string | null;
  description: string | null;
  is_system: boolean;
  permissions: PermissionOption[];
}

const props = defineProps<{
  roles: RoleRow[];
  permissions: PermissionOption[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Administration', href: '/admin/roles' },
  { title: 'Roles', href: '/admin/roles' },
];

const { can } = useAuthorization();
const editingRole = ref<RoleRow | null>(null);

const form = useForm({
  name           : '',
  label          : '',
  description    : '',
  permission_ids : [] as number[],
});

const isEditing = computed(() => editingRole.value !== null);
const groupedPermissions = computed(() => {
  return props.permissions.reduce<Record<string, PermissionOption[]>>((groups, permission) => {
    const group = permission.name.split('.')[0] || 'general';
    groups[group] = groups[group] || [];
    groups[group].push(permission);
    return groups;
  }, {});
});

const resetForm = () => {
  editingRole.value = null;
  form.reset();
  form.clearErrors();
  form.permission_ids = [];
};

const editRole = (role: RoleRow) => {
  editingRole.value = role;
  form.clearErrors();
  form.name = role.name;
  form.label = role.label || '';
  form.description = role.description || '';
  form.permission_ids = role.permissions.map(permission => permission.id);
};

const submit = () => {
  if (editingRole.value) {
    form.put(`/admin/roles/${editingRole.value.id}`, {
      preserveScroll : true,
      onSuccess      : resetForm,
    });
    return;
  }

  form.post('/admin/roles', {
    preserveScroll : true,
    onSuccess      : resetForm,
  });
};

const destroyRole = (role: RoleRow) => {
  if (!window.confirm(`Delete role ${role.label || role.name}?`)) {
    return;
  }

  router.delete(`/admin/roles/${role.id}`, { preserveScroll: true });
};
</script>

<template>
  <Head title="Roles" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="vstack gap-4">
      <div>
        <h1 class="h3 mb-1">Roles</h1>
        <p class="text-muted mb-0">Group permissions into reusable access profiles.</p>
      </div>

      <div class="row g-4">
        <div class="col-lg-7">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table align-middle">
                  <thead>
                    <tr>
                      <th>Role</th>
                      <th>Permissions</th>
                      <th class="text-end">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="role in props.roles" :key="role.id">
                      <td>
                        <div class="fw-semibold">{{ role.label || role.name }}</div>
                        <div class="text-muted small">{{ role.name }}</div>
                      </td>
                      <td>
                        <span class="badge text-bg-secondary">{{ role.permissions.length }}</span>
                      </td>
                      <td class="text-end">
                        <button
                          v-if="can('roles.update')"
                          type="button"
                          class="btn btn-sm btn-outline-primary me-2"
                          @click="editRole(role)"
                        >
                          Edit
                        </button>
                        <button
                          v-if="can('roles.delete') && !role.is_system"
                          type="button"
                          class="btn btn-sm btn-outline-danger"
                          @click="destroyRole(role)"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <h2 class="h5 mb-3">{{ isEditing ? 'Edit role' : 'Create role' }}</h2>

              <form class="vstack gap-3" @submit.prevent="submit">
                <div>
                  <label for="name" class="form-label">Name</label>
                  <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    :disabled="Boolean(editingRole?.is_system)"
                  />
                  <InputError :message="form.errors.name" />
                </div>

                <div>
                  <label for="label" class="form-label">Label</label>
                  <input id="label" v-model="form.label" type="text" class="form-control" />
                  <InputError :message="form.errors.label" />
                </div>

                <div>
                  <label for="description" class="form-label">Description</label>
                  <textarea id="description" v-model="form.description" class="form-control" rows="2"></textarea>
                  <InputError :message="form.errors.description" />
                </div>

                <div class="vstack gap-3">
                  <div
                    v-for="(items, group) in groupedPermissions"
                    :key="group"
                  >
                    <p class="text-uppercase text-muted small fw-semibold mb-2">{{ group }}</p>
                    <div class="vstack gap-2">
                      <label
                        v-for="permission in items"
                        :key="permission.id"
                        class="form-check"
                      >
                        <input
                          v-model="form.permission_ids"
                          class="form-check-input"
                          type="checkbox"
                          :value="permission.id"
                        />
                        <span class="form-check-label">
                          {{ permission.label || permission.name }}
                          <span class="text-muted small">({{ permission.name }})</span>
                        </span>
                      </label>
                    </div>
                  </div>
                  <InputError :message="form.errors.permission_ids" />
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <button type="button" class="btn btn-outline-secondary" @click="resetForm">Cancel</button>
                  <button type="submit" class="btn btn-primary" :disabled="form.processing">
                    {{ isEditing ? 'Save role' : 'Create role' }}
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
