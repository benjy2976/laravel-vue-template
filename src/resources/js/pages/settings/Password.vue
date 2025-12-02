<script setup lang="ts">
import PasswordController from '@/actions/App/Http/Controllers/Settings/PasswordController';
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit } from '@/routes/user-password';
import { Form, Head } from '@inertiajs/vue3';

import HeadingSmall from '@/components/HeadingSmall.vue';
import { type BreadcrumbItem } from '@/types';

const breadcrumbItems: BreadcrumbItem[] = [
  {
    title : 'Password settings',
    href  : edit().url,
  },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Password settings" />

        <SettingsLayout>
            <div class="vstack gap-4">
                <HeadingSmall
                    title="Update password"
                    description="Ensure your account is using a long, random password to stay secure"
                />

                <Form
                    v-bind="PasswordController.update.form()"
                    :options="{
                        preserveScroll: true,
                    }"
                    reset-on-success
                    :reset-on-error="[
                        'password',
                        'password_confirmation',
                        'current_password',
                    ]"
                    class="vstack gap-4"
                    v-slot="{ errors, processing, recentlySuccessful }"
                >
                    <div>
                        <label for="current_password" class="form-label">Current password</label>
                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            class="form-control"
                            autocomplete="current-password"
                            placeholder="Current password"
                        />
                        <InputError :message="errors.current_password" />
                    </div>

                    <div>
                        <label for="password" class="form-label">New password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="form-control"
                            autocomplete="new-password"
                            placeholder="New password"
                        />
                        <InputError :message="errors.password" />
                    </div>

                    <div>
                        <label
for="password_confirmation"
class="form-label"
                            >Confirm password</label
                        >
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="form-control"
                            autocomplete="new-password"
                            placeholder="Confirm password"
                        />
                        <InputError :message="errors.password_confirmation" />
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button
                            type="submit"
                            class="btn btn-primary"
                            :disabled="processing"
                            data-test="update-password-button"
                        >
                            Save password
                        </button>

                        <Transition
                            enter-active-class="fade show"
                            enter-from-class="opacity-0"
                            leave-active-class="fade"
                            leave-to-class="opacity-0"
                        >
                            <p
                                v-show="recentlySuccessful"
                                class="text-success small mb-0"
                            >
                                Saved.
                            </p>
                        </Transition>
                    </div>
                </Form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
