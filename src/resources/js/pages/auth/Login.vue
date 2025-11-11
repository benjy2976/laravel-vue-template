<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Form, Head, Link } from '@inertiajs/vue3';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <AuthBase
        title="Log in to your account"
        description="Enter your email and password below to log in"
    >
        <Head title="Log in" />

        <div v-if="status" class="alert alert-success text-center small">
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="vstack gap-4"
            autocomplete="on"
        >
            <div>
                <label for="email" class="form-label">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    required
                    autofocus
                    :tabindex="1"
                    autocomplete="username"
                    placeholder="email@example.com"
                    class="form-control"
                />
                <InputError :message="errors.email" />
            </div>

            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <label for="password" class="form-label mb-0"
                        >Password</label
                    >
                    <Link
                        v-if="canResetPassword"
                        :href="request()"
                        class="btn btn-link btn-sm p-0"
                        :tabindex="5"
                    >
                        Forgot password?
                    </Link>
                </div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    :tabindex="2"
                    autocomplete="current-password"
                    placeholder="Password"
                    class="form-control"
                />
                <InputError :message="errors.password" />
            </div>

            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="remember"
                    name="remember"
                    :tabindex="3"
                />
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
                :tabindex="4"
                :disabled="processing"
                data-test="login-button"
            >
                <span
                    v-if="processing"
                    class="spinner-border spinner-border-sm me-2"
                />
                Log in
            </button>

            <div class="text-center small text-muted" v-if="canRegister">
                Don't have an account?
                <Link :href="register()" :tabindex="5" class="btn btn-link p-0"
                    >Sign up</Link
                >
            </div>
        </Form>
    </AuthBase>
</template>
