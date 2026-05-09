# Contexto: Componentes transversales

## Proposito

Concentrar componentes y composables reutilizables para UX, formularios y CRUDs del template.

## UX transversal

- `feedback/AppToastViewport.vue`: muestra notificaciones globales desde `auth.flash`/flash compartido por Inertia.
- `composables/useToasts.ts`: API programatica para agregar, cerrar o limpiar toasts.
- Los controladores Laravel deben usar `with('success'|'error'|'warning'|'info', '...')` para acciones de usuario.
- Los mensajes deben ser genericos y no incluir vocabulario de negocio salvo que el proyecto derivado lo defina.

## Formularios y errores

- `forms/FormErrorSummary.vue`: resumen visible de errores de formulario.
- `composables/useFormErrors.ts`: normaliza errores de Inertia/Laravel a una lista plana.
- Mantener `InputError.vue` para errores puntuales por campo.
- En formularios CRUD, usar resumen general y errores por campo cuando el formulario pueda fallar por reglas cruzadas.

## CRUD toolkit

- `crud/CrudPageHeader.vue`: titulo, descripcion y acciones de pagina.
- `crud/CrudSearchForm.vue`: busqueda GET estandar con `router.get`.
- `crud/CrudTable.vue`: tabla generica con columnas y slots por celda.
- `crud/CrudPagination.vue`: paginacion para links de Laravel/Inertia.
- `crud/types.ts`: tipos compartidos para columnas, paginadores y links.

## Reglas de uso

1. Antes de crear un nuevo CRUD, revisar si estos componentes cubren el caso.
2. Mantener columnas, filtros y acciones en la pagina del modulo; el toolkit solo resuelve estructura reusable.
3. No meter reglas de negocio dentro de componentes `crud/**`.
4. Para acciones sensibles, confirmar con el usuario antes de enviar `DELETE` o cambios irreversibles.
5. Si un CRUD necesita filtros multiples, extender el patron de `CrudSearchForm` sin romper la API simple.
