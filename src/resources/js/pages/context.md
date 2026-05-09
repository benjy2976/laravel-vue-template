# Contexto: Pages base

## Proposito

Documentar paginas base del template que no pertenecen todavia a un modulo de negocio.

## Actores y permisos

- Visitante: accede a `Welcome`.
- Usuario autenticado y verificado: accede a `Dashboard`.

## Entidades y relaciones relevantes

- No hay entidades de negocio propias en el template base.
- `Dashboard` es placeholder inicial para proyectos derivados.

## Estados y transiciones

- visitante -> welcome.
- usuario autenticado/verificado -> dashboard.

## Reglas de negocio

1. Mantener `Dashboard` como pantalla generica hasta que el proyecto derivado defina su dominio.
2. No agregar widgets de negocio especificos al template.
3. Si se agrega una nueva seccion funcional estable, moverla a su propia carpeta y crear `context.md`.

## Rutas involucradas

- `GET /`
- `GET /dashboard`

## UI y rutas

- `src/resources/js/pages/Welcome.vue`
- `src/resources/js/pages/Dashboard.vue`

## Errores esperables

- Usuario no autenticado intentando acceder a dashboard: redireccion a login.
- Usuario no verificado intentando acceder a dashboard: flujo de verificacion segun middleware.

## Pruebas manuales minimas

1. Abrir `/` como visitante.
2. Iniciar sesion.
3. Confirmar acceso a `/dashboard`.
4. Cerrar sesion y verificar proteccion de dashboard.
