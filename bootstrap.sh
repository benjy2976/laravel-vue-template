#!/usr/bin/env bash
set -euo pipefail

echo "==> Levantando contenedores..."
docker compose up -d --build

echo "==> Preparando .env de Laravel..."
if [ ! -f src/.env ]; then
  cp src/.env.example src/.env
fi

echo "==> Instalando dependencias PHP..."
docker compose exec -u app app bash -lc 'composer install'

echo "==> Instalando dependencias JS..."
docker compose exec -u app app bash -lc 'npm install'

echo "==> Generando APP_KEY y enlaces..."
docker compose exec -u app app bash -lc 'php artisan key:generate || true'
docker compose exec -u app app bash -lc 'php artisan storage:link || true'

echo "==> Ejecutando migraciones..."
docker compose exec -u app app bash -lc 'php artisan migrate'

echo "==> Listo. Abre http://localhost:8080"
echo "   Mailpit: http://localhost:8025"
echo "   Vite: make npm-dev"
