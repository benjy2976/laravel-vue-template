# Laravel + Inertia + Vue Template

Template Dockerizado para proyectos Laravel 12 con Inertia, Vue 3, TypeScript, Fortify, PostgreSQL, Redis y Mailpit.

## Memoria del proyecto

Este repositorio incluye un sistema de memoria para trabajar con agentes IA sin acoplar la plantilla a un dominio de negocio especifico.

- `AGENT_PROTOCOL.md`: punto de entrada operativo para agentes.
- `_standard/`: molde portable para inicializar memoria en proyectos derivados.
- `docs/`: arquitectura, entorno, convenciones, procedimientos y tests del template.
- `.github/copilot-instructions.md`: instrucciones generales para IA.
- `.github/prompts/`: prompts reutilizables.
- `.github/instructions/`: reglas por capa.
- `src/AGENTS.md`: reglas Laravel Boost y stack versionado.

## Requisitos

- Docker y Docker Compose.
- Make opcional.

## Puesta en marcha

```bash
cp src/.env.example src/.env
docker compose up -d --build
docker compose exec -u app app bash -lc "composer install"
docker compose exec -u app app bash -lc "php artisan key:generate"
docker compose exec -u app app bash -lc "php artisan storage:link"
docker compose exec -u app app bash -lc "php artisan migrate"
docker compose exec -u app app bash -lc "npm install"
```

Abrir:
- App: `http://localhost:8080`
- Mailpit: `http://localhost:8025`

## Desarrollo con Vite

```bash
docker compose exec -u app app bash -lc "npm run dev -- --host 0.0.0.0"
```

Vite queda expuesto en `http://localhost:5173`.

## Comandos utiles

```bash
make up
make sh
make migrate
make test
make npm-dev
make npm-build
make down
```

## Validacion

```bash
docker compose exec -u app app bash -lc "php artisan test"
docker compose exec -u app app bash -lc "vendor/bin/pint"
docker compose exec -u app app bash -lc "npm run format"
docker compose exec -u app app bash -lc "npm run lint"
docker compose exec -u app app bash -lc "npm run build"
```

## Principio de plantilla

El template debe permanecer generico. Los proyectos derivados pueden agregar dominio, modulos, permisos y reglas de negocio, pero esas decisiones no deben volver a la plantilla salvo que sean patrones reutilizables.
