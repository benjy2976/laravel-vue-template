<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface PermissionRow {
  id: number;
  name: string;
  label: string | null;
  description: string | null;
  is_system: boolean;
  is_menu: boolean;
  menu_label: string | null;
  menu_path: string | null;
  icon: string | null;
  parent_id: number | null;
  sort_order: number;
}

interface MenuParent {
  id: number;
  name: string;
  label: string | null;
  menu_label: string | null;
}

const props = defineProps<{
  permissions: PermissionRow[];
  menuParents: MenuParent[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Administration', href: '/admin/permissions' },
  { title: 'Permissions', href: '/admin/permissions' },
];

const editingPermission = ref<PermissionRow | null>(null);

const form = useForm({
  label       : '',
  description : '',
  is_menu     : false,
  menu_label  : '',
  menu_path   : '',
  icon        : '',
  parent_id   : '' as number | string,
  sort_order  : 0,
});

const editableParents = computed(() => {
  return props.menuParents.filter(parent => parent.id !== editingPermission.value?.id);
});

const editPermission = (permission: PermissionRow) => {
  editingPermission.value = permission;
  form.clearErrors();
  form.label = permission.label || '';
  form.description = permission.description || '';
  form.is_menu = permission.is_menu;
  form.menu_label = permission.menu_label || '';
  form.menu_path = permission.menu_path || '';
  form.icon = permission.icon || '';
  form.parent_id = permission.parent_id || '';
  form.sort_order = permission.sort_order || 0;
};

const resetForm = () => {
  editingPermission.value = null;
  form.reset();
  form.clearErrors();
};

const submit = () => {
  if (!editingPermission.value) {
    return;
  }

  form.put(`/admin/permissions/${editingPermission.value.id}`, {
    preserveScroll : true,
    onSuccess      : resetForm,
  });
};
</script>

<template>
  <Head title="Permissions" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="vstack gap-4">
      <div>
        <h1 class="h3 mb-1">Permissions</h1>
        <p class="text-muted mb-0">Review base permissions and edit menu metadata.</p>
      </div>

      <div class="row g-4">
        <div class="col-lg-7">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table align-middle">
                  <thead>
                    <tr>
                      <th>Permission</th>
                      <th>Menu</th>
                      <th>Order</th>
                      <th class="text-end">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="permission in props.permissions" :key="permission.id">
                      <td>
                        <div class="fw-semibold">{{ permission.label || permission.name }}</div>
                        <div class="text-muted small">{{ permission.name }}</div>
                      </td>
                      <td>
                        <span
                          class="badge"
                          :class="permission.is_menu ? 'text-bg-success' : 'text-bg-secondary'"
                        >
                          {{ permission.is_menu ? 'Visible' : 'Hidden' }}
                        </span>
                      </td>
                      <td>{{ permission.sort_order }}</td>
                      <td class="text-end">
                        <button
                          type="button"
                          class="btn btn-sm btn-outline-primary"
                          @click="editPermission(permission)"
                        >
                          Edit
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
              <h2 class="h5 mb-3">
                {{ editingPermission ? `Edit ${editingPermission.name}` : 'Select a permission' }}
              </h2>

              <form v-if="editingPermission" class="vstack gap-3" @submit.prevent="submit">
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

                <label class="form-check">
                  <input v-model="form.is_menu" class="form-check-input" type="checkbox" />
                  <span class="form-check-label">Show in menu</span>
                </label>

                <div>
                  <label for="menu_label" class="form-label">Menu label</label>
                  <input id="menu_label" v-model="form.menu_label" type="text" class="form-control" />
                  <InputError :message="form.errors.menu_label" />
                </div>

                <div>
                  <label for="menu_path" class="form-label">Menu path</label>
                  <input id="menu_path" v-model="form.menu_path" type="text" class="form-control" placeholder="/admin/users" />
                  <InputError :message="form.errors.menu_path" />
                </div>

                <div>
                  <label for="icon" class="form-label">Icon</label>
                  <input id="icon" v-model="form.icon" type="text" class="form-control" placeholder="Users" />
                  <InputError :message="form.errors.icon" />
                </div>

                <div>
                  <label for="parent_id" class="form-label">Parent</label>
                  <select id="parent_id" v-model="form.parent_id" class="form-select">
                    <option value="">No parent</option>
                    <option
                      v-for="parent in editableParents"
                      :key="parent.id"
                      :value="parent.id"
                    >
                      {{ parent.menu_label || parent.label || parent.name }}
                    </option>
                  </select>
                  <InputError :message="form.errors.parent_id" />
                </div>

                <div>
                  <label for="sort_order" class="form-label">Sort order</label>
                  <input id="sort_order" v-model.number="form.sort_order" type="number" min="0" class="form-control" />
                  <InputError :message="form.errors.sort_order" />
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <button type="button" class="btn btn-outline-secondary" @click="resetForm">Cancel</button>
                  <button type="submit" class="btn btn-primary" :disabled="form.processing">Save metadata</button>
                </div>
              </form>

              <p v-else class="text-muted mb-0">Choose a permission from the table to update its label or menu settings.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
