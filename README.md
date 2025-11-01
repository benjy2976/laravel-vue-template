# Laravel + Docker (PHP 8.3, Nginx, Postgres 17, Redis, Mailpit, Node 22)

Monolito simple para apps pequeñas (Blade + Vite). Ideal para empezar rápido.

## Requisitos
- Docker y Docker Compose
- (Opcional) Make

## Pasos rápidos
```bash
cp .env.example .env
docker compose up -d --build
docker compose exec -u app app bash -lc "composer create-project laravel/laravel . && php artisan key:generate && php artisan storage:link"
```

Abre: `http://localhost:8080`  
Mailpit: `http://localhost:8025`

### Vite (HMR)
```bash
docker compose run --rm -p 5173:5173 node sh -lc "npm ci && npm run dev -- --host"
```

## Variables clave (.env)
- DB_HOST=db / DB_CONNECTION=pgsql (Postgres 17)
- REDIS_HOST=redis
- MAIL: host `mailpit`, puerto `1025` (captura emails en desarrollo)

## Comandos útiles (Make)
- `make up` / `make down` / `make logs`
- `make init` (crea Laravel si no existe)
- `make migrate` / `make seed`
- `make npm-install` / `make npm-dev` / `make npm-build`

## Separar el frontend (opcional)
Si luego quieres un SPA separado (Vue/React) crea un repo/carpeta `frontend/` con su propio Dockerfile y publica el build en Nginx como `root /var/www/html/public;` sirviendo los assets compilados. En Laravel cambia `VITE_*` por rutas absolutas a los assets estáticos o usa un bucket/CDN.# laravel-vue-template
