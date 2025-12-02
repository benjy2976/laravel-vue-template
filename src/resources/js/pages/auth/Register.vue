<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthBase from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { store } from '@/routes/register';
import { Form, Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <AuthBase
        title="Create an account"
        description="Enter your details below to create your account"
    >
        <Head title="Register" />

        <Form
            v-bind="store.form()"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
            class="vstack gap-4"
        >
            <div>
                <label for="name" class="form-label">Name</label>
                <input
                    id="name"
                    type="text"
                    required
                    autofocus
                    :tabindex="1"
                    autocomplete="name"
                    name="name"
                    placeholder="Full name"
                    class="form-control"
                />
                <InputError :message="errors.name" />
            </div>

            <div>
                <label for="email" class="form-label">Email address</label>
                <input
                    id="email"
                    type="email"
                    required
                    :tabindex="2"
                    autocomplete="email"
                    name="email"
                    placeholder="email@example.com"
                    class="form-control"
                />
                <InputError :message="errors.email" />
            </div>

            <div>
                <label for="password" class="form-label">Password</label>
                <input
                    id="password"
                    type="password"
                    required
                    :tabindex="3"
                    autocomplete="new-password"
                    name="password"
                    placeholder="Password"
                    class="form-control"
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
                    type="password"
                    required
                    :tabindex="4"
                    autocomplete="new-password"
                    name="password_confirmation"
                    placeholder="Confirm password"
                    class="form-control"
                />
                <InputError :message="errors.password_confirmation" />
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
                tabindex="5"
                :disabled="processing"
                data-test="register-user-button"
            >
                <span
                    v-if="processing"
                    class="spinner-border spinner-border-sm me-2"
                ></span>
                Create account
            </button>

            <div class="text-center small text-muted">
                Already have an account?
                <Link
:href="login()"
class="btn btn-link p-0"
:tabindex="6"
                    >Log in</Link
                >
            </div>
        </Form>
    </AuthBase>
</template>
