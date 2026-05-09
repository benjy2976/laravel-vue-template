# Entorno

## Requisitos

- Docker y Docker Compose.
- Make opcional.
- Node 22 y PHP 8.3 solo si se ejecuta sin contenedor.

## Servicios Docker

| Servicio | Puerto local | Descripcion |
|----------|--------------|-------------|
| `web` | `8080` | Nginx sirviendo Laravel desde `src/public` |
| `app` | `5173` | PHP-FPM 8.3 con Composer, Node y Vite HMR |
| `db` | `5432` | PostgreSQL 17 |
| `redis` | `6379` | Cache/sesiones/colas segun `.env` |
| `mailpit` | `8025`, `1025` | UI y SMTP de desarrollo |

## Variables de entorno

El archivo operativo de Laravel vive en:
- `src/.env`

El archivo root `.env.example` sirve como referencia Docker, pero la aplicacion lee `src/.env`.

Variables clave:

| Variable | Valor esperado en Docker |
|----------|--------------------------|
| `APP_URL` | `http://localhost:8080` |
| `DB_CONNECTION` | `pgsql` |
| `DB_HOST` | `db` |
| `DB_PORT` | `5432` |
| `DB_DATABASE` | `laravel` |
| `DB_USERNAME` | `laravel` |
| `DB_PASSWORD` | `laravel` |
| `REDIS_HOST` | `redis` |
| `MAIL_HOST` | `mailpit` |
| `MAIL_PORT` | `1025` |
| `VITE_APP_NAME` | `${APP_NAME}` |
| `VITE_HOST` | `localhost` |
| `VITE_PORT` | `5173` |

## Alias de imports

| Alias | Ruta real |
|-------|-----------|
| `@/*` | `src/resources/js/*` |

## Notas

- El contenedor `app` instala PHP, extensiones Laravel, Composer, Node y npm.
- Vite debe escuchar en `0.0.0.0` dentro del contenedor para exponer HMR al host.
- `bootstrap.sh` y `Makefile` deben operar sobre `src/.env`, no sobre `.env` de la raiz.
