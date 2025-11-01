SHELL := /bin/bash

up:
	docker compose up -d --build

down:
	docker compose down

logs:
	docker compose logs -f --tail=100

sh:
	docker compose exec app bash

init:
	# Create a fresh Laravel project inside ./src
	docker compose exec -u app app bash -lc 'if [ -f artisan ]; then echo "✔ Laravel ya existe"; else composer create-project laravel/laravel .; fi'
	docker compose exec -u app app bash -lc 'php artisan key:generate'
	docker compose exec -u app app bash -lc 'php artisan storage:link'

migrate:
	docker compose exec app bash -lc 'php artisan migrate'

seed:
	docker compose exec app bash -lc 'php artisan db:seed'

npm-install:
	docker compose run --rm node sh -lc 'npm ci || npm install'

npm-dev:
	docker compose run --rm -p 5173:5173 node sh -lc 'npm run dev -- --host'

npm-build:
	docker compose run --rm node sh -lc 'npm run build'