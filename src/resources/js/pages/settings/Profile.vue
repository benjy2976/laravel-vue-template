<script setup lang="ts">
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';
import { Form, Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const breadcrumbItems: BreadcrumbItem[] = [
  {
    title : 'Profile settings',
    href  : edit().url,
  },
];

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Profile settings" />

        <SettingsLayout>
            <div class="flex flex-col space-y-6">
                <HeadingSmall
                    title="Profile information"
                    description="Update your name and email address"
                />

                <Form
                    v-bind="ProfileController.update.form()"
                    class="vstack gap-4"
                    v-slot="{ errors, processing, recentlySuccessful }"
                >
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input
                            id="name"
                            class="form-control"
                            name="name"
                            :value="user.name"
                            required
                            autocomplete="name"
                            placeholder="Full name"
                        />
                        <InputError :message="errors.name" />
                    </div>

                    <div>
                        <label for="email" class="form-label">Email address</label>
                        <input
                            id="email"
                            type="email"
                            class="form-control"
                            name="email"
                            :value="user.email"
                            required
                            autocomplete="username"
                            placeholder="Email address"
                        />
                        <InputError :message="errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at">
                        <p class="text-warning small mb-2">
                            Your email address is unverified.
                            <Link
                                :href="send()"
                                as="button"
                                class="btn btn-link btn-sm px-0 align-baseline"
                            >
                                Click here to resend the verification email.
                            </Link>
                        </p>

                        <div
                            v-if="status === 'verification-link-sent'"
                            class="alert alert-success py-2 px-3"
                        >
                            A new verification link has been sent to your email
                            address.
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button
                            type="submit"
                            class="btn btn-primary"
                            :disabled="processing"
                            data-test="update-profile-button"
                        >
                            Save
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

            <DeleteUser />
        </SettingsLayout>
    </AppLayout>
</template>
