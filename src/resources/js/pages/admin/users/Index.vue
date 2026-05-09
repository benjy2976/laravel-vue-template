<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { useAuthorization } from '@/composables/useAuthorization';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface RoleOption {
  id: number;
  name: string;
  label: string | null;
}

interface UserRow {
  id: number;
  name: string;
  email: string;
  created_at: string | null;
  roles: RoleOption[];
}

interface UsersPaginator {
  data: UserRow[];
  links: { url: string | null; label: string; active: boolean }[];
}

const props = defineProps<{
  users: UsersPaginator;
  roles: RoleOption[];
  filters: { search?: string };
}>();

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Administration', href: '/admin/users' },
  { title: 'Users', href: '/admin/users' },
];

const { can } = useAuthorization();
const editingUser = ref<UserRow | null>(null);
const search = ref(props.filters.search ?? '');

const form = useForm({
  name                  : '',
  email                 : '',
  password              : '',
  password_confirmation : '',
  role_ids              : [] as number[],
});

const isEditing = computed(() => editingUser.value !== null);

const resetForm = () => {
  editingUser.value = null;
  form.reset();
  form.clearErrors();
  form.role_ids = [];
};

const editUser = (user: UserRow) => {
  editingUser.value = user;
  form.clearErrors();
  form.name = user.name;
  form.email = user.email;
  form.password = '';
  form.password_confirmation = '';
  form.role_ids = user.roles.map(role => role.id);
};

const submit = () => {
  if (editingUser.value) {
    form.put(`/admin/users/${editingUser.value.id}`, {
      preserveScroll : true,
      onSuccess      : resetForm,
    });
    return;
  }

  form.post('/admin/users', {
    preserveScroll : true,
    onSuccess      : resetForm,
  });
};

const destroyUser = (user: UserRow) => {
  if (!window.confirm(`Delete user ${user.email}?`)) {
    return;
  }

  router.delete(`/admin/users/${user.id}`, { preserveScroll: true });
};

const applySearch = () => {
  router.get('/admin/users', { search: search.value || undefined }, {
    preserveState : true,
    replace       : true,
  });
};

const paginationLabel = (label: string) => label
  .replace('&laquo;', '')
  .replace('&raquo;', '')
  .trim();
</script>

<template>
  <Head title="Users" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="vstack gap-4">
      <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
        <div>
          <h1 class="h3 mb-1">Users</h1>
          <p class="text-muted mb-0">Manage generic user access for projects derived from this template.</p>
        </div>

        <form class="d-flex gap-2" @submit.prevent="applySearch">
          <input
            v-model="search"
            type="search"
            class="form-control"
            placeholder="Search users"
          />
          <button type="submit" class="btn btn-outline-secondary">Search</button>
        </form>
      </div>

      <div class="row g-4">
        <div class="col-lg-7">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table align-middle">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Roles</th>
                      <th class="text-end">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in props.users.data" :key="user.id">
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>
                        <span
                          v-for="role in user.roles"
                          :key="role.id"
                          class="badge text-bg-secondary me-1"
                        >
                          {{ role.label || role.name }}
                        </span>
                      </td>
                      <td class="text-end">
                        <button
                          v-if="can('users.update')"
                          type="button"
                          class="btn btn-sm btn-outline-primary me-2"
                          @click="editUser(user)"
                        >
                          Edit
                        </button>
                        <button
                          v-if="can('users.delete')"
                          type="button"
                          class="btn btn-sm btn-outline-danger"
                          @click="destroyUser(user)"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                    <tr v-if="!props.users.data.length">
                      <td colspan="4" class="text-center text-muted py-4">No users found.</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <nav v-if="props.users.links.length > 3" aria-label="Users pagination">
                <ul class="pagination mb-0">
                  <li
                    v-for="link in props.users.links"
                    :key="link.label"
                    class="page-item"
                    :class="{ active: link.active, disabled: !link.url }"
                  >
                    <Link
                      class="page-link"
                      :href="link.url || '#'"
                    >
                      {{ paginationLabel(link.label) }}
                    </Link>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <h2 class="h5 mb-3">{{ isEditing ? 'Edit user' : 'Create user' }}</h2>

              <form class="vstack gap-3" @submit.prevent="submit">
                <div>
                  <label for="name" class="form-label">Name</label>
                  <input id="name" v-model="form.name" type="text" class="form-control" />
                  <InputError :message="form.errors.name" />
                </div>

                <div>
                  <label for="email" class="form-label">Email</label>
                  <input id="email" v-model="form.email" type="email" class="form-control" />
                  <InputError :message="form.errors.email" />
                </div>

                <div>
                  <label for="password" class="form-label">Password</label>
                  <input id="password" v-model="form.password" type="password" class="form-control" />
                  <InputError :message="form.errors.password" />
                </div>

                <div>
                  <label for="password_confirmation" class="form-label">Confirm password</label>
                  <input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="form-control"
                  />
                  <InputError :message="form.errors.password_confirmation" />
                </div>

                <div>
                  <p class="form-label mb-2">Roles</p>
                  <div class="vstack gap-2">
                    <label
                      v-for="role in props.roles"
                      :key="role.id"
                      class="form-check"
                    >
                      <input
                        v-model="form.role_ids"
                        class="form-check-input"
                        type="checkbox"
                        :value="role.id"
                      />
                      <span class="form-check-label">{{ role.label || role.name }}</span>
                    </label>
                  </div>
                  <InputError :message="form.errors.role_ids" />
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <button type="button" class="btn btn-outline-secondary" @click="resetForm">Cancel</button>
                  <button type="submit" class="btn btn-primary" :disabled="form.processing">
                    {{ isEditing ? 'Save user' : 'Create user' }}
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
