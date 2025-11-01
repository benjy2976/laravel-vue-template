#!/usr/bin/env bash
set -euo pipefail

echo "==> Levantando contenedores..."
docker compose up -d --build

echo "==> Creando proyecto Laravel (si no existe)..."
docker compose exec -u app app bash -lc 'if [ -f artisan ]; then echo "✔ Laravel ya existe"; else composer create-project laravel/laravel .; fi'

echo "==> Generando APP_KEY y enlaces..."
docker compose exec -u app app bash -lc 'php artisan key:generate || true'
docker compose exec -u app app bash -lc 'php artisan storage:link || true'

echo "==> Ajustando .env"
if [ ! -f .env ]; then
  cp .env.example .env
fi

echo "==> Listo. Abre http://localhost:8080"
echo "   - Mailpit en http://localhost:8025"
echo "   - Vite: ejecuta \`make npm-dev\` para HMR"