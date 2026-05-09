import type { InertiaLinkProps } from '@inertiajs/vue3';

export interface CrudColumn {
  key: string;
  label: string;
  headerClass?: string;
  cellClass?: string;
}

export interface CrudPaginationLink {
  url: string | null;
  label: string;
  active: boolean;
}

export interface CrudPaginator<T> {
  data: T[];
  links: CrudPaginationLink[];
}

export interface CrudSearchPayload {
  route: NonNullable<InertiaLinkProps['href']>;
  queryKey?: string;
}
