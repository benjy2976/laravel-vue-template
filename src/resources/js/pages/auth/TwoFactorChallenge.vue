<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/two-factor/login';
import { Form, Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface AuthConfigContent {
    title: string;
    description: string;
    toggleText: string;
}

const authConfigContent = computed<AuthConfigContent>(() => {
    if (showRecoveryInput.value) {
        return {
            title: 'Recovery Code',
            description:
                'Please confirm access to your account by entering one of your emergency recovery codes.',
            toggleText: 'login using an authentication code',
        };
    }

    return {
        title: 'Authentication Code',
        description:
            'Enter the authentication code provided by your authenticator application.',
        toggleText: 'login using a recovery code',
    };
});

const showRecoveryInput = ref<boolean>(false);

const toggleRecoveryMode = (clearErrors: () => void): void => {
    showRecoveryInput.value = !showRecoveryInput.value;
    clearErrors();
    code.value = [];
};

const code = ref<number[]>([]);
const codeValue = computed<string>(() => code.value.join('').substring(0, 6));
</script>

<template>
    <AuthLayout
        :title="authConfigContent.title"
        :description="authConfigContent.description"
    >
        <Head title="Two-Factor Authentication" />

        <div class="space-y-6">
            <template v-if="!showRecoveryInput">
                <Form
                    v-bind="store.form()"
                    class="space-y-4"
                    reset-on-error
                    @error="code = []"
                    #default="{ errors, processing, clearErrors }"
                >
                    <input type="hidden" name="code" :value="codeValue" />
                    <div
                        class="flex flex-col items-center justify-center space-y-3 text-center"
                    >
                        <div class="d-flex justify-content-between gap-2">
                            <input
                                v-for="(_, index) in 6"
                                :key="index"
                                type="text"
                                maxlength="1"
                                inputmode="numeric"
                                class="form-control text-center fs-4 otp-slot"
                                :disabled="processing"
                                v-model="code[index]"
                                @input="
                                    ($event) => {
                                        const value = $event.target.value.replace(/[^0-9]/g, '');
                                        code[index] = value;
                                        if (value && $event.target.nextElementSibling) {
                                            $event.target.nextElementSibling.focus();
                                        }
                                    }
                                "
                                @keydown.backspace="
                                    ($event) => {
                                        if (!$event.target.value && $event.target.previousElementSibling) {
                                            $event.target.previousElementSibling.focus();
                                        }
                                    }
                                "
                            />
                        </div>
                        <InputError :message="errors.code" />
                    </div>
                    <button type="submit" class="btn btn-primary w-100" :disabled="processing">
                        Continue
                    </button>
                    <div class="text-center small text-muted">
                        <span>or you can </span>
                        <button
                            type="button"
                            class="btn btn-link p-0 align-baseline"
                            @click="() => toggleRecoveryMode(clearErrors)"
                        >
                            {{ authConfigContent.toggleText }}
                        </button>
                    </div>
                </Form>
            </template>

            <template v-else>
                <Form
                    v-bind="store.form()"
                    class="space-y-4"
                    reset-on-error
                    #default="{ errors, processing, clearErrors }"
                >
                    <input
                        name="recovery_code"
                        type="text"
                        class="form-control"
                        placeholder="Enter recovery code"
                        :autofocus="showRecoveryInput"
                        required
                    />
                    <InputError :message="errors.recovery_code" />
                    <button type="submit" class="btn btn-primary w-100" :disabled="processing">
                        Continue
                    </button>

                    <div class="text-center small text-muted">
                        <span>or you can </span>
                        <button
                            type="button"
                            class="btn btn-link p-0 align-baseline"
                            @click="() => toggleRecoveryMode(clearErrors)"
                        >
                            {{ authConfigContent.toggleText }}
                        </button>
                    </div>
                </Form>
            </template>
        </div>
    </AuthLayout>
</template>
