# Procedimientos

## Objetivo

Concentrar los pasos operativos del template: entorno, desarrollo, validacion, CI y creacion de nuevas areas.

## Entorno y arranque

```bash
# Copiar variables base
cp src/.env.example src/.env

# Levantar servicios, incluido Vite HMR
docker compose up -d --build

# Instalar dependencias PHP
docker compose exec -u app app bash -lc "composer install"

# Preparar Laravel
docker compose exec -u app app bash -lc "php artisan key:generate"
docker compose exec -u app app bash -lc "php artisan storage:link"
docker compose exec -u app app bash -lc "php artisan migrate"

# Instalar dependencias JS manualmente si no se levanto el servicio vite
docker compose exec -u app app bash -lc "npm install"
```

Servicios esperados:
- App web: `http://localhost:8080`
- Vite HMR: `http://localhost:5173`
- Mailpit: `http://localhost:8025`
- PostgreSQL interno: `db:5432`, host local `5432`
- Redis interno: `redis:6379`

## Desarrollo

```bash
# Ver logs del servicio Vite HMR
docker compose logs -f vite

# Desarrollo Laravel + Vite con scripts Composer, si se ejecuta localmente dentro de src
cd src
composer run dev
```

## Migraciones y datos base

```bash
# Crear migracion
docker compose exec -u app app bash -lc "php artisan make:migration nombre_de_migracion"

# Ejecutar migraciones
docker compose exec -u app app bash -lc "php artisan migrate"

# Ejecutar seeders
docker compose exec -u app app bash -lc "php artisan db:seed"
```

Reglas:
- Crear migraciones nuevas para modificar estructura existente.
- Pensar compatibilidad con PostgreSQL y SQLite de tests.
- No agregar tablas de negocio al template base salvo que el usuario lo pida.

## Validacion tecnica

### PHP / Laravel

```bash
# Toda la suite
docker compose exec -u app app bash -lc "php artisan test"

# Test puntual
docker compose exec -u app app bash -lc "php artisan test tests/Feature/Auth/AuthenticationTest.php"

# Formato PHP
docker compose exec -u app app bash -lc "vendor/bin/pint"
```

### Frontend

```bash
# Formato
docker compose exec -u app app bash -lc "npm run format"

# Revisar formato
docker compose exec -u app app bash -lc "npm run format:check"

# ESLint con fix segun script actual
docker compose exec -u app app bash -lc "npm run lint"

# Build
docker compose exec -u app app bash -lc "npm run build"
```

## CI

Los workflows viven en `.github/workflows/**` y ejecutan desde `src/`.
Si se agregan jobs nuevos, configurar `working-directory: src` o rutas explicitas porque el proyecto Laravel vive dentro de `src/`.

## Backups

El template base no incluye scripts de backup por modelo porque todavia no define tablas de negocio.
Los scripts por modelo de proyectos derivados deben agregarse solo cuando existan dominios estables y tablas reales.

Reglas sugeridas para proyectos derivados:
- Documentar modelos/tablas respaldables en `scripts/db_models_pg.sh` o equivalente.
- Separar backup completo de backup por modelo.
- No acoplar el template base a tablas de un proyecto concreto.
- Documentar restauracion y riesgos antes de automatizar operaciones destructivas.

## Generacion de nuevas areas funcionales

1. Revisar si ya existe un area equivalente.
2. Leer `docs/context-template.md`.
3. Definir permisos con el patron `<modulo>.(view|create|update|delete)` y menu si aplica.
4. Crear migraciones, modelos, Form Requests, controladores Inertia y rutas web.
5. Usar el CRUD toolkit en frontend: `CrudPageHeader`, `CrudTable`, `CrudPagination`, `CrudSearchForm`.
6. Usar feedback transversal: `FormErrorSummary`, `InputError` y flash con `with('success'|'error'|'warning'|'info', ...)`.
7. Crear `context.md` del area.
8. Indexar el contexto en `docs/guia_IA.md`.
9. Agregar tests si hay reglas de backend o flujo critico.

## Cierre tecnico obligatorio

1. Revisar si el cambio afecta memoria (`docs/`, `.github/`, `_standard/`, `context.md`).
2. Ejecutar validaciones requeridas por el alcance.
3. Si hubo cambios funcionales, actualizar el `context.md`.
4. Si se creo un nuevo `context.md`, indexarlo en `docs/guia_IA.md`.
5. Reportar cambios, validaciones y riesgos pendientes.
