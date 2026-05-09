# Instrucciones para la IA

## Punto de entrada

Antes de actuar, leer `AGENT_PROTOCOL.md` y seguir su orden de lectura, preflight y cierre.
`docs/` y `.github/` son la memoria normativa. `src/AGENTS.md` conserva las reglas Laravel Boost del stack.

## Estilo

- Responder en espanol, claro y conciso.
- Referenciar archivos con rutas relativas.
- No inventar endpoints, dependencias, modelos ni reglas de negocio.
- Si hay ambiguedad o conflicto entre documentos, pedir confirmacion antes de editar.

## Reglas clave

- Mantener este repositorio como template generico y adaptable.
- No copiar logica de negocio de proyectos derivados.
- Antes de tocar Laravel/backend, leer `.github/instructions/laravel.instructions.md`.
- Antes de tocar Inertia/Vue, leer `.github/instructions/inertia-vue.instructions.md`.
- Antes de tocar Docker/CI/entorno, leer `.github/instructions/docker.instructions.md`.
- Antes de tocar un area funcional, leer su `context.md` si existe.

## Prohibiciones

- No acceder a red externa salvo solicitud explicita.
- No exponer credenciales ni datos sensibles.
- No modificar memoria (`docs/`, `.github/`, `_standard/`, `context.md`) sin aprobacion cuando la tarea no sea precisamente memoria.
- No omitir validaciones criticas.
