# Tests del proyecto

## Objetivo

Documentar como se valida el template y que areas base cubren los tests.

## Como ejecutar

```bash
# Suite completa
docker compose exec -u app app bash -lc "php artisan test"

# Archivo puntual
docker compose exec -u app app bash -lc "php artisan test tests/Feature/Auth/AuthenticationTest.php"

# Base administrativa heredable
docker compose exec -u app app bash -lc "php artisan test tests/Feature/Admin/AdminAccessTest.php"

# Frontend
docker compose exec -u app app bash -lc "npm run build"
docker compose exec -u app app bash -lc "npm run lint"

# Pest directo dentro de src
cd src
./vendor/bin/pest
```

## Cobertura base actual

### Auth
- `tests/Feature/Auth/AuthenticationTest.php`
- `tests/Feature/Auth/EmailVerificationTest.php`
- `tests/Feature/Auth/PasswordConfirmationTest.php`
- `tests/Feature/Auth/PasswordResetTest.php`
- `tests/Feature/Auth/RegistrationTest.php`
- `tests/Feature/Auth/TwoFactorChallengeTest.php`
- `tests/Feature/Auth/VerificationNotificationTest.php`

### Settings
- `tests/Feature/Settings/ProfileUpdateTest.php`
- `tests/Feature/Settings/PasswordUpdateTest.php`
- `tests/Feature/Settings/TwoFactorAuthenticationTest.php`

### Base app
- `tests/Feature/DashboardTest.php`
- `tests/Feature/ExampleTest.php`
- `tests/Unit/ExampleTest.php`

### Admin base
- `tests/Feature/Admin/AdminAccessTest.php`

### UX/CRUD frontend
- Validar con ESLint y `npm run build`.
- Si el cambio solo toca componentes Vue sin backend, no requiere Pest salvo que altere rutas o props compartidas.

## Reglas

- Usar Pest para tests nuevos.
- Priorizar feature tests para flujos Inertia/Laravel.
- Al tocar auth, settings o middleware, ejecutar el test puntual relacionado.
- Al tocar migraciones o modelo `User`, ejecutar auth/settings relacionados.
- Al tocar roles, permisos, menu dinamico o administracion, ejecutar `tests/Feature/Admin/AdminAccessTest.php`.
- Al tocar flash compartido, props Inertia o helpers globales, ejecutar build frontend y tests de feature afectados.
- Al tocar frontend sin backend, ejecutar build/lint segun alcance.
