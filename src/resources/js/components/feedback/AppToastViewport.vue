<script setup lang="ts">
import { useToasts, type ToastVariant } from '@/composables/useToasts';
import type { AppPageProps, FlashMessages } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { CheckCircle2, CircleAlert, Info, TriangleAlert, X } from 'lucide-vue-next';
import { computed, watch } from 'vue';

const page = usePage<AppPageProps>();
const { pushToast, removeToast, toasts } = useToasts();

const iconMap = {
  error   : CircleAlert,
  info    : Info,
  success : CheckCircle2,
  warning : TriangleAlert,
};

const classMap: Record<ToastVariant, string> = {
  error   : 'text-bg-danger',
  info    : 'text-bg-primary',
  success : 'text-bg-success',
  warning : 'text-bg-warning',
};

const flash = computed(() => page.props.flash);

const pushFlashMessage = (
  messages: FlashMessages,
  key: ToastVariant,
) => {
  const message = messages[key];

  if (!message) {
    return;
  }

  pushToast({
    message,
    variant : key,
  });
};

watch(
  () => flash.value?.id,
  () => {
    if (!flash.value?.id) {
      return;
    }

    pushFlashMessage(flash.value, 'success');
    pushFlashMessage(flash.value, 'error');
    pushFlashMessage(flash.value, 'warning');
    pushFlashMessage(flash.value, 'info');
  },
  { immediate: true },
);
</script>

<template>
  <div
    v-if="toasts.length"
    class="app-toast-viewport"
    aria-live="polite"
    aria-atomic="true"
  >
    <div
      v-for="toast in toasts"
      :key="toast.id"
      class="toast show border-0 shadow"
      :class="classMap[toast.variant]"
      role="status"
    >
      <div class="toast-body d-flex align-items-start gap-3">
        <component
          :is="iconMap[toast.variant]"
          class="flex-shrink-0 mt-1"
          :size="18"
        />
        <div class="min-w-0 flex-grow-1">
          <div class="fw-semibold">{{ toast.title }}</div>
          <div>{{ toast.message }}</div>
        </div>
        <button
          type="button"
          class="btn btn-sm btn-link p-0 text-reset opacity-75"
          aria-label="Dismiss notification"
          @click="removeToast(toast.id)"
        >
          <X :size="16" />
        </button>
      </div>
    </div>
  </div>
</template>
