---
applyTo:
  - src/app/**
  - src/routes/**
  - src/database/**
  - src/config/**
  - src/bootstrap/**
  - src/tests/**
---

# Instrucciones Laravel

- Leer `src/AGENTS.md` antes de cambiar codigo Laravel.
- Seguir estructura Laravel 12: bootstrap en `src/bootstrap/app.php`, rutas en `src/routes/**`, providers en `src/bootstrap/providers.php`.
- Preferir rutas nombradas y helpers Wayfinder cuando el frontend consuma rutas.
- Usar Form Requests cuando la validacion sea reutilizable o compleja.
- No crear nuevas carpetas base sin aprobacion.
- No agregar modulos de negocio especificos al template base.
- Para modelos, relaciones y queries, usar Eloquent y tipado explicito.
- Para migraciones, crear archivos nuevos y contemplar PostgreSQL + SQLite de tests.
- Para cambios en auth/settings, revisar tests relacionados antes de cerrar.

## Validacion de cierre

- PHP: `php artisan test` o test puntual relevante.
- Formato: `vendor/bin/pint` cuando se toquen archivos PHP.
