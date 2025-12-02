<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { update } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    token: string;
    email: string;
}>();

const inputEmail = ref(props.email);
</script>

<template>
    <AuthLayout
        title="Reset password"
        description="Please enter your new password below"
    >
        <Head title="Reset password" />

        <Form
            v-bind="update.form()"
            :transform="(data) => ({ ...data, token, email })"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
            class="vstack gap-4"
        >
            <div>
                <label for="email" class="form-label">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    autocomplete="email"
                    v-model="inputEmail"
                    class="form-control"
                    readonly
                />
                <InputError :message="errors.email" />
            </div>

            <div>
                <label for="password" class="form-label">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    class="form-control"
                    autofocus
                    placeholder="Password"
                />
                <InputError :message="errors.password" />
            </div>

            <div>
                <label for="password_confirmation" class="form-label">
                    Confirm Password
                </label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    autocomplete="new-password"
                    class="form-control"
                    placeholder="Confirm password"
                />
                <InputError :message="errors.password_confirmation" />
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
                :disabled="processing"
                data-test="reset-password-button"
            >
                <span
                    v-if="processing"
                    class="spinner-border spinner-border-sm me-2"
                ></span>
                Reset password
            </button>
        </Form>
    </AuthLayout>
</template>
