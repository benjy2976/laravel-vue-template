import type { FormErrors } from '@/types';
import { computed, type MaybeRefOrGetter, toValue } from 'vue';

const normalizeError = (error: string | string[] | undefined): string[] => {
  if (!error) {
    return [];
  }

  return Array.isArray(error) ? error : [error];
};

export const flattenFormErrors = (errors: FormErrors = {}) => {
  return Object.values(errors)
    .flatMap(normalizeError)
    .filter(Boolean);
};

export function useFormErrors(errors: MaybeRefOrGetter<FormErrors>) {
  const messages = computed(() => flattenFormErrors(toValue(errors)));
  const hasErrors = computed(() => messages.value.length > 0);

  const firstError = (field: string) => {
    const value = toValue(errors)[field];

    return normalizeError(value)[0];
  };

  return {
    firstError,
    hasErrors,
    messages,
  };
}
