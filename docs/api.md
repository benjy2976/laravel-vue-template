# API

## Estado actual

Este template no define una API JSON transversal como superficie principal. La aplicacion base usa rutas web Laravel + Inertia + formularios/actions generados por Wayfinder.

## Regla

- No agregar endpoints JSON globales al template sin necesidad explicita.
- Si un proyecto derivado requiere API, documentar aqui:
  - rutas,
  - autenticacion,
  - formato de errores,
  - versionado,
  - consumidores esperados.

## Convencion sugerida si se agrega API

- Rutas en `src/routes/api.php` si el proyecto lo habilita.
- Controllers en `src/app/Http/Controllers/Api/**`.
- Respuestas JSON consistentes: `message`, `data` y `errors` cuando aplique.
- Tests Feature por endpoint critico.
