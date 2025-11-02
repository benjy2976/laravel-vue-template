# Laravel + Docker (PHP 8.3, Nginx, Postgres 17, Redis, Mailpit, Node 22)

Monolito simple para apps pequeñas (Blade + Vite). Ideal para empezar rápido.

## Requisitos
- Docker y Docker Compose
- (Opcional) Make

## Puesta en marcha con Docker

1. **Configura variables de entorno**
   ```bash
   cp src/.env.example src/.env
   ```

2. **Arranca la pila**
   ```bash
   docker compose up -d --build
   ```

3. **Instala dependencias de Laravel y prepara la app**
   ```bash
   docker compose exec -u app app bash -lc "composer install"
   docker compose exec -u app app bash -lc "php artisan key:generate"
   docker compose exec -u app app bash -lc "php artisan storage:link"
   # opcional: migraciones/seeders
   docker compose exec -u app app bash -lc "php artisan migrate"
   ```

4. **Instala dependencias de Node/Vite**
   ```bash
   docker compose exec -u app app bash -lc "npm install"
   ```

5. **Sirve la app**
   - Backend + Nginx ya están expuestos en `http://localhost:8080`.
   - Mailpit queda en `http://localhost:8025`.

### Desarrollo (Vite + HMR)
Ejecuta en una terminal separada para mantener el proceso vivo:

```bash
docker compose exec -u app app bash -lc "npm run dev -- --host"
```

### Build para producción
Genera los assets en `public/build`:

```bash
docker compose exec -u app app bash -lc "npm run build"
```

> Cuando termines, puedes detener todo con `docker compose down`.

## Variables clave (.env)
- DB_HOST=db / DB_CONNECTION=pgsql (Postgres 17)
- REDIS_HOST=redis
- MAIL: host `mailpit`, puerto `1025` (captura emails en desarrollo)

## Comandos útiles (Make)
- `make up` / `make down` / `make logs`
- `make init` (crea Laravel si no existe)
- `make migrate` / `make seed`
- `make npm-install` / `make npm-dev` / `make npm-build`

## VS Code / ESLint
- La dependencia de frontend vive en `src/`, por lo que el lint se resuelve desde `src/node_modules`.
- El repo incluye un `.vscode/settings.json` que ajusta `eslint.nodePath`, fija el directorio de trabajo en `src/` y habilita `eslint.useFlatConfig` para que la extensión respete `src/eslint.config.js`.
- Si usas otro editor, asegúrate de correr ESLint desde `src/` o replica esas rutas en tu configuración local.

## Separar el frontend (opcional)
Si luego quieres un SPA separado (Vue/React) crea un repo/carpeta `frontend/` con su propio Dockerfile y publica el build en Nginx como `root /var/www/html/public;` sirviendo los assets compilados. En Laravel cambia `VITE_*` por rutas absolutas a los assets estáticos o usa un bucket/CDN.

# laravel-vue-template
