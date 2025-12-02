<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import TwoFactorSetupModal from '@/components/TwoFactorSetupModal.vue';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { disable, enable, show } from '@/routes/two-factor';
import { BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { ShieldBan, ShieldCheck } from 'lucide-vue-next';
import { onUnmounted, ref } from 'vue';

interface Props {
    requiresConfirmation?: boolean;
    twoFactorEnabled?: boolean;
}

withDefaults(defineProps<Props>(), {
  requiresConfirmation : false,
  twoFactorEnabled     : false,
});

const breadcrumbs: BreadcrumbItem[] = [
  {
    title : 'Two-Factor Authentication',
    href  : show.url(),
  },
];

const { hasSetupData, clearTwoFactorAuthData } = useTwoFactorAuth();
const showSetupModal = ref<boolean>(false);

onUnmounted(() => {
  clearTwoFactorAuthData();
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Two-Factor Authentication" />
        <SettingsLayout>
            <div class="vstack gap-4">
                <HeadingSmall
                    title="Two-Factor Authentication"
                    description="Manage your two-factor authentication settings"
                />

                <div
                    v-if="!twoFactorEnabled"
                    class="card border-0 shadow-sm"
                >
                    <div class="card-body">
                        <span class="badge text-bg-danger">Disabled</span>

                        <p class="text-muted small my-3">
                            When you enable two-factor authentication, you will be prompted for a secure pin during login. This pin can be retrieved from a TOTP-supported application on your phone.
                        </p>

                        <div class="d-flex gap-2">
                            <button
                                v-if="hasSetupData"
                                type="button"
                                class="btn btn-primary"
                                @click="showSetupModal = true"
                            >
                                <ShieldCheck class="me-1" :size="16" /> Continue Setup
                            </button>
                            <Form
                                v-else
                                v-bind="enable.form()"
                                @success="showSetupModal = true"
                                #default="{ processing }"
                            >
                                <button type="submit" class="btn btn-primary" :disabled="processing">
                                    <ShieldCheck class="me-1" :size="16" />
                                    Enable 2FA
                                </button>
                            </Form>
                        </div>
                    </div>
                </div>

                <div
                    v-else
                    class="vstack gap-4"
                >
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <span class="badge text-bg-success">Enabled</span>
                            <p class="text-muted small my-3">
                                With two-factor authentication enabled, you will be prompted for a secure pin during login, which you can retrieve from the TOTP-supported application on your phone.
                            </p>
                            <Form v-bind="disable.form()" #default="{ processing }">
                                <button class="btn btn-danger" type="submit" :disabled="processing">
                                    <ShieldBan class="me-1" :size="16" />
                                    Disable 2FA
                                </button>
                            </Form>
                        </div>
                    </div>

                    <TwoFactorRecoveryCodes />
                </div>

                <TwoFactorSetupModal
                    v-model:isOpen="showSetupModal"
                    :requiresConfirmation="requiresConfirmation"
                    :twoFactorEnabled="twoFactorEnabled"
                />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
