<script setup lang="ts">
import { ref } from 'vue';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';

const { twoFactorAuthData } = useTwoFactorAuth();
const showCodes = ref(false);
</script>

<template>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-1">Recovery Codes</h6>
                    <p class="text-muted small mb-0">
                        Store these codes securely. Each can be used once to recover access.
                    </p>
                </div>
                <button
                    type="button"
                    class="btn btn-outline-secondary btn-sm"
                    @click="showCodes = !showCodes"
                >
                    {{ showCodes ? 'Hide' : 'Show' }}
                </button>
            </div>

            <ul v-if="showCodes && twoFactorAuthData?.recovery_codes?.length" class="list-group list-group-flush mt-3">
                <li
                    v-for="code in twoFactorAuthData.recovery_codes"
                    :key="code"
                    class="list-group-item d-flex justify-content-between align-items-center"
                >
                    <code class="fw-semibold">{{ code }}</code>
                    <button
                        type="button"
                        class="btn btn-link btn-sm"
                        @click="navigator.clipboard.writeText(code)"
                    >
                        Copy
                    </button>
                </li>
            </ul>
            <p v-else-if="showCodes" class="text-muted small mt-3 mb-0">
                Recovery codes will appear here after enabling two-factor authentication.
            </p>
        </div>
    </div>
</template>
