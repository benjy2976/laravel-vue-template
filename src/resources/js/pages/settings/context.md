# Contexto: Settings

## Proposito

Documentar el area base de configuracion de usuario del template.

## Actores y permisos

- Usuario autenticado: puede editar perfil, password, apariencia y two-factor segun configuracion Fortify.

## Entidades y relaciones relevantes

- `App\Models\User`
- Requests de settings en `src/app/Http/Requests/Settings/**`.
- Controllers en `src/app/Http/Controllers/Settings/**`.

## Estados y transiciones

- perfil actualizado: cambios validos guardados.
- email verificado -> email pendiente: al cambiar email si el usuario implementa verificacion.
- password actual -> password nuevo: cambio validado con password actual.
- two-factor deshabilitado -> habilitado: configuracion Fortify completada.

## Reglas de negocio

1. Requerir autenticacion para todas las rutas de settings.
2. No exponer settings a visitantes.
3. Mantener validaciones en backend para cambios persistentes.
4. Si se toca password/profile/two-factor, ejecutar tests de `tests/Feature/Settings/**`.

## Rutas involucradas

- `GET /settings/profile`
- `PATCH /settings/profile`
- `DELETE /settings/profile`
- `GET /settings/password`
- `PUT /settings/password`
- `GET /settings/appearance`
- `GET /settings/two-factor`

## UI y rutas

- `src/resources/js/pages/settings/Profile.vue`
- `src/resources/js/pages/settings/Password.vue`
- `src/resources/js/pages/settings/Appearance.vue`
- `src/resources/js/pages/settings/TwoFactor.vue`
- `src/resources/js/layouts/settings/Layout.vue`

## Errores esperables

- Password actual incorrecto.
- Email invalido o duplicado.
- Campos requeridos ausentes.
- Confirmacion de password requerida para two-factor.

## Pruebas manuales minimas

1. Iniciar sesion.
2. Editar nombre y email.
3. Cambiar password con password actual correcto.
4. Cambiar apariencia.
5. Revisar pantalla de two-factor si esta habilitada.
