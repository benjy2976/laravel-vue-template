import { computed, reactive } from 'vue';

export type ToastVariant = 'success' | 'error' | 'warning' | 'info';

export interface ToastPayload {
  title?: string;
  message: string;
  variant?: ToastVariant;
  timeout?: number;
}

export interface ToastItem extends Required<ToastPayload> {
  id: string;
}

const DEFAULT_TIMEOUT = 5000;
const toasts = reactive<ToastItem[]>([]);

const variantTitles: Record<ToastVariant, string> = {
  error   : 'Error',
  info    : 'Information',
  success : 'Success',
  warning : 'Warning',
};

const nextToastId = () => {
  if (typeof crypto !== 'undefined' && crypto.randomUUID) {
    return crypto.randomUUID();
  }

  return `${Date.now()}-${Math.random().toString(16).slice(2)}`;
};

export function useToasts() {
  const pushToast = (payload: ToastPayload) => {
    const variant = payload.variant ?? 'info';
    const timeout = payload.timeout ?? DEFAULT_TIMEOUT;
    const toast: ToastItem = {
      id      : nextToastId(),
      message : payload.message,
      timeout,
      title   : payload.title ?? variantTitles[variant],
      variant,
    };

    toasts.push(toast);

    if (timeout > 0) {
      window.setTimeout(() => removeToast(toast.id), timeout);
    }

    return toast.id;
  };

  const removeToast = (id: string) => {
    const index = toasts.findIndex(toast => toast.id === id);

    if (index >= 0) {
      toasts.splice(index, 1);
    }
  };

  const clearToasts = () => {
    toasts.splice(0, toasts.length);
  };

  return {
    clearToasts,
    pushToast,
    removeToast,
    toasts : computed(() => toasts),
  };
}
