# Contexto: Auth

## Proposito

Documentar el flujo base de autenticacion del template Laravel + Fortify + Inertia.

## Actores y permisos

- Visitante: puede iniciar sesion, registrarse si Fortify lo permite, solicitar reset de password y confirmar email.
- Usuario autenticado: puede cerrar sesion y acceder a rutas protegidas.

## Entidades y relaciones relevantes

- `App\Models\User`
- Tokens y estados internos gestionados por Fortify/Laravel.

## Estados y transiciones

- visitante -> autenticado: login correcto.
- autenticado -> visitante: logout.
- email no verificado -> email verificado: link firmado de verificacion.
- password olvidado -> password restablecido: token valido de reset.

## Reglas de negocio

1. Mantener Fortify como fuente del flujo auth base.
2. Usar rutas y acciones Wayfinder existentes cuando esten disponibles.
3. No agregar reglas de negocio de producto al auth del template.
4. Si se modifica auth, ejecutar tests de `tests/Feature/Auth/**`.

## Rutas involucradas

- `GET /`
- `GET /dashboard`
- Rutas Fortify generadas para login, register, password reset, confirm password, email verification y two-factor challenge.

## UI y rutas

- `src/resources/js/pages/auth/Login.vue`
- `src/resources/js/pages/auth/Register.vue`
- `src/resources/js/pages/auth/ForgotPassword.vue`
- `src/resources/js/pages/auth/ResetPassword.vue`
- `src/resources/js/pages/auth/ConfirmPassword.vue`
- `src/resources/js/pages/auth/TwoFactorChallenge.vue`
- `src/resources/js/pages/auth/VerifyEmail.vue`

## Errores esperables

- Credenciales invalidas.
- Email requerido/no valido.
- Password invalido o no confirmado.
- Token de reset expirado o invalido.
- Codigo two-factor invalido.

## Pruebas manuales minimas

1. Abrir login.
2. Iniciar sesion con usuario valido.
3. Cerrar sesion.
4. Probar reset de password con Mailpit.
5. Si two-factor esta activo, verificar challenge.
