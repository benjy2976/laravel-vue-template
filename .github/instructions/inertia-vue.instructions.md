---
applyTo:
  - src/resources/js/**
  - src/resources/css/**
  - src/resources/views/**
---

# Instrucciones Inertia/Vue

- Paginas en `src/resources/js/pages/**`.
- Layouts en `src/resources/js/layouts/**`.
- Componentes compartidos en `src/resources/js/components/**`.
- Composables en `src/resources/js/composables/**` con prefijo `use`.
- Usar alias `@/` para imports hacia `resources/js`.
- Usar Wayfinder (`@/routes`, `@/actions`) cuando exista helper generado.
- Mantener componentes genericos; evitar textos o reglas de negocio cerradas en el template.
- Seguir el estilo de archivos vecinos antes de introducir un patron nuevo.
- Leer `context.md` del area si existe.

## Validacion de cierre

- Frontend: `npm run format`, `npm run lint` o validacion puntual equivalente segun alcance.
- Build: `npm run build` si se tocan entradas Vite, layouts globales o configuracion.
