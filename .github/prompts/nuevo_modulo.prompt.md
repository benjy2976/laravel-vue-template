# Prompt: Nuevo módulo (backend + frontend)

Sigue `base_universal.prompt.md` como preamble obligatorio.

Instrucciones adicionales para crear un módulo nuevo:

## Antes de escribir código
1. Verificar que no exista ya un módulo con el mismo propósito o uno similar.
2. Leer `docs/arquitectura.md` para entender dónde debe vivir el nuevo módulo.
3. Leer `docs/context-template.md` para saber qué documentar.
4. Si el módulo tiene dependencias de otro módulo, leer su `context.md`.

## Preflight adicional
- Nombre del módulo propuesto (en inglés, según convenciones)
- Namespace Laravel/Inertia al que pertenece
- Permisos que requiere (patrón `<módulo>.(view|create|edit|delete)`)
- Entidades de datos que gestiona
- Dependencias de otros módulos
- Entrada de menu requerida (`is_menu`, `menu_label`, `menu_path`, `icon`, `parent_id`, `sort_order`)

## Orden de trabajo obligatorio

### Backend
1. Migración (nueva tabla o cambio de esquema)
2. Modelo con relaciones y docblocks
3. Form Requests para validacion y autorizacion
4. Controlador Inertia con middleware `permission`
5. Registro en rutas web
6. Seeder de permisos y menu
7. Tests mínimos

### Frontend
1. Pagina Inertia en `src/resources/js/pages/<namespace>/<modulo>/`
2. Usar `AppLayout` y breadcrumbs del modulo
3. Usar `CrudPageHeader`, `CrudTable`, `CrudPagination` y `CrudSearchForm` cuando apliquen
4. Usar `FormErrorSummary` e `InputError` en formularios
5. Usar `useAuthorization` para ocultar acciones por permiso
6. `context.md` del módulo
7. Indexar en `docs/guia_IA.md`

## Al finalizar
- Confirmar que el `context.md` existe y está completo
- Confirmar que está indexado en `docs/guia_IA.md`
- Confirmar que el modulo no agrega lenguaje ni reglas de negocio al template salvo que sea un proyecto derivado
- Ejecutar validaciones de cierre de ambas capas
