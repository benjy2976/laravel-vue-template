SHELL := /bin/bash

up:
	docker compose up -d --build

down:
	docker compose down

logs:
	docker compose logs -f --tail=100

sh:
	docker compose exec -u app app bash

install:
	docker compose exec -u app app bash -lc 'composer install'
	docker compose exec -u app app bash -lc 'npm install'

init:
	docker compose exec -u app app bash -lc 'test -f .env || cp .env.example .env'
	docker compose exec -u app app bash -lc 'php artisan key:generate || true'
	docker compose exec -u app app bash -lc 'php artisan storage:link || true'
	docker compose exec -u app app bash -lc 'php artisan migrate'

migrate:
	docker compose exec -u app app bash -lc 'php artisan migrate'

seed:
	docker compose exec -u app app bash -lc 'php artisan db:seed'

test:
	docker compose exec -u app app bash -lc 'php artisan test'

pint:
	docker compose exec -u app app bash -lc 'vendor/bin/pint'

npm-install:
	docker compose exec -u app app bash -lc 'npm install'

npm-dev:
	docker compose exec -u app app bash -lc 'npm run dev -- --host 0.0.0.0'

npm-build:
	docker compose exec -u app app bash -lc 'npm run build'
