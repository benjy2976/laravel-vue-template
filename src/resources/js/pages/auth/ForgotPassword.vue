<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { email } from '@/routes/password';
import { Form, Head, Link } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        title="Forgot password"
        description="Enter your email to receive a password reset link"
    >
        <Head title="Forgot password" />

        <div v-if="status" class="alert alert-success text-center small">
            {{ status }}
        </div>

        <Form
            v-bind="email.form()"
            v-slot="{ errors, processing }"
            class="vstack gap-4"
        >
            <div>
                <label for="email" class="form-label">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    autocomplete="off"
                    autofocus
                    placeholder="email@example.com"
                    class="form-control"
                />
                <InputError :message="errors.email" />
            </div>

            <button
                class="btn btn-primary w-100"
                :disabled="processing"
                data-test="email-password-reset-link-button"
            >
                <span
                    v-if="processing"
                    class="spinner-border spinner-border-sm me-2"
                ></span>
                Email password reset link
            </button>

            <div class="text-center small text-muted">
                <span>Or, return to </span>
                <Link :href="login()" class="btn btn-link p-0">log in</Link>
            </div>
        </Form>
    </AuthLayout>
</template>
