# Tests del proyecto

## Objetivo

Documentar como se valida el template y que areas base cubren los tests.

## Como ejecutar

```bash
# Suite completa
docker compose exec -u app app bash -lc "php artisan test"

# Archivo puntual
docker compose exec -u app app bash -lc "php artisan test tests/Feature/Auth/AuthenticationTest.php"

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

## Reglas

- Usar Pest para tests nuevos.
- Priorizar feature tests para flujos Inertia/Laravel.
- Al tocar auth, settings o middleware, ejecutar el test puntual relacionado.
- Al tocar migraciones o modelo `User`, ejecutar auth/settings relacionados.
- Al tocar frontend sin backend, ejecutar build/lint segun alcance.
