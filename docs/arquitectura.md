# Arquitectura del proyecto

## Objetivo

Definir el mapa global del template, sus capas y el flujo base de datos entre Laravel, Inertia y Vue.

## Stack actual

- Backend/app: Laravel 12, PHP 8.3, Fortify, Inertia Laravel, Wayfinder.
- Frontend integrado: Vue 3, TypeScript, Inertia Vue, Vite, Tailwind CSS 4 y Bootstrap 5.
- UI base: componentes propios y componentes `resources/js/components/ui/**`.
- Administracion base: usuarios, roles, permisos y menu dinamico por permisos.
- UX transversal: toasts globales, resumen de errores y componentes CRUD reutilizables.
- Tests: Pest/PHPUnit.
- Infraestructura: Docker Compose con PHP-FPM, Nginx, PostgreSQL 17, Redis y Mailpit.

## Capas del sistema

| # | Capa | Responsabilidad | Donde vive |
|---|------|-----------------|------------|
| 1 | Rutas web | Entradas HTTP, middleware y render Inertia | `src/routes/**` |
| 2 | Aplicacion Laravel | Controllers, requests, actions, modelos y providers | `src/app/**` |
| 3 | Vistas Inertia | Paginas Vue renderizadas por Laravel | `src/resources/js/pages/**` |
| 4 | Layout y componentes | Shell visual, navegacion, UI reusable | `src/resources/js/layouts/**`, `src/resources/js/components/**` |
| 5 | Assets y estilos | CSS global y bootstrap visual | `src/resources/css/**` |
| 6 | Persistencia | Migraciones, factories, seeders y SQLite de desarrollo | `src/database/**` |
| 7 | Validacion | Pest/PHPUnit, Pint, Prettier y ESLint | `src/tests/**`, workflows |
| 8 | Infraestructura local | Contenedores, Nginx y scripts de arranque | `docker-compose.yml`, `docker/**`, `Makefile` |

## Mapa Laravel

```text
src/
├── app/Actions/Fortify/          # Acciones de auth provistas por Fortify
├── app/Http/Controllers/         # Controladores web e Inertia
├── app/Http/Middleware/           # Middleware web y autorizacion por permiso
├── app/Http/Requests/            # Form Requests reutilizables
├── app/Models/                   # Modelos Eloquent
├── app/Providers/                # Providers de Laravel y Fortify
├── bootstrap/                    # Bootstrap de Laravel 12
├── config/                       # Configuracion de framework y paquetes
├── database/                     # Migraciones, factories y seeders
├── routes/                       # Rutas web, settings y console
└── tests/                        # Pest tests
```

## Mapa Inertia/Vue

```text
src/resources/js/
├── actions/                      # Wayfinder: acciones generadas desde backend
├── components/                   # Componentes compartidos
├── components/crud/              # Toolkit CRUD reutilizable
├── components/feedback/          # Feedback global y toasts
├── components/forms/             # Helpers de formularios
├── components/ui/                # Componentes UI base
├── composables/                  # Logica reusable de Vue
├── layouts/                      # Layouts de app, auth y settings
├── pages/                        # Paginas Inertia
├── routes/                       # Wayfinder: helpers de rutas
├── types/                        # Tipos globales TS
└── app.ts                        # Entrada cliente
```

## Flujo global de datos

1. Una ruta Laravel recibe la peticion.
2. El controlador o closure valida permisos/middleware.
3. Laravel renderiza una pagina Inertia con props.
4. Vue consume props, acciones Wayfinder y componentes compartidos.
5. Formularios Inertia envian POST/PATCH/PUT/DELETE hacia rutas nombradas.
6. Laravel valida, persiste y redirige o devuelve errores.

## Base administrativa heredable

- RBAC simple del template: `User` tiene muchos `Role`; `Role` tiene muchos `Permission`.
- Middleware `permission:{name}` protege rutas administrativas reutilizables.
- `RolePermissionSeeder` crea roles base `admin` y `user` con permisos genericos.
- El sidebar autenticado consume `auth.menu`, generado desde permisos con metadatos de menu.
- La UI administrativa vive en `src/resources/js/pages/admin/**` y solo cubre usuarios, roles y metadatos de permisos.

## UX transversal y CRUD toolkit

- Flash Laravel se comparte en `HandleInertiaRequests` como `flash` y se renderiza con `AppToastViewport`.
- Para formularios, combinar `FormErrorSummary` con `InputError` por campo.
- CRUDs nuevos deben preferir `CrudPageHeader`, `CrudSearchForm`, `CrudTable` y `CrudPagination`.
- El toolkit solo provee estructura UI; filtros, columnas y acciones viven en cada modulo.

## Principios de diseno

- Mantener el template generico y adaptable.
- No introducir modulos de negocio cerrados en la plantilla base.
- Preferir rutas nombradas y helpers Wayfinder sobre strings manuales.
- Mantener la logica de negocio fuera de componentes cuando requiera validacion persistente.
- Documentar areas funcionales en `context.md` solo con reglas reutilizables o propias del template base.

## Componentes y helpers compartidos

- `src/resources/js/layouts/AppLayout.vue`: layout principal autenticado.
- `src/resources/js/layouts/AuthLayout.vue`: layout de pantallas de autenticacion.
- `src/resources/js/layouts/settings/Layout.vue`: shell de settings.
- `src/resources/js/components/InputError.vue`: salida comun para errores de formularios.
- `src/resources/js/composables/useAppearance.ts`: preferencia visual.
- `src/resources/js/composables/useAuthorization.ts`: lectura de roles/permisos compartidos por Inertia.
- `src/resources/js/composables/useFormErrors.ts`: normalizacion de errores de formularios.
- `src/resources/js/composables/useToasts.ts`: API de notificaciones globales.
- `src/resources/js/composables/useTwoFactorAuth.ts`: flujo de two-factor.

## Donde vive cada tipo de conocimiento

| Conocimiento | Archivo |
|--------------|---------|
| Protocolo operativo del agente | `AGENT_PROTOCOL.md` |
| Reglas AI y mapa de contextos | `docs/guia_IA.md` |
| Convenciones tecnicas | `docs/convenciones.md` |
| Comandos operativos | `docs/procedimientos.md` |
| Entorno y variables | `docs/entorno.md` |
| Cobertura y validacion | `docs/tests.md` |
| Reglas Laravel Boost | `src/AGENTS.md` |
| Negocio/flujo por area | `context.md` del area |
| Componentes transversales | `src/resources/js/components/context.md` |
