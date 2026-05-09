# Agent Protocol

## Rol de este archivo

Punto de entrada operativo para cualquier agente AI que trabaje en este repositorio.
No reemplaza la memoria normativa de `docs/` ni `.github/`; define el orden de lectura, el loop de trabajo y lo que debe mostrarse al usuario.
Si una regla de este archivo choca con `docs/`, `.github/` o `src/AGENTS.md`, detenerse, explicar el conflicto y pedir confirmacion.

---

## Orden de lectura obligatorio antes de actuar

### Siempre
1. Este archivo completo.
2. `docs/guia_IA.md`
3. `.github/copilot-instructions.md`
4. `docs/convenciones.md`
5. `docs/procedimientos.md`
6. `src/AGENTS.md` para reglas Laravel Boost y stack versionado.

### Si la tarea toca Laravel/backend
7. `.github/instructions/laravel.instructions.md`
8. `context.md` del modulo afectado, si existe.

Aplica a:
- `src/app/**`
- `src/routes/**`
- `src/database/**`
- `src/config/**`
- `src/bootstrap/**`
- `src/tests/**`

### Si la tarea toca Inertia/Vue
7. `.github/instructions/inertia-vue.instructions.md`
8. `context.md` del modulo o area afectada, si existe.

Aplica a:
- `src/resources/js/**`
- `src/resources/css/**`
- `src/resources/views/**`

### Si la tarea toca entorno, Docker o automatizacion
7. `.github/instructions/docker.instructions.md`
8. `docs/entorno.md`

Aplica a:
- `docker-compose.yml`
- `docker/**`
- `.env.example`
- `bootstrap.sh`
- `Makefile`
- `.github/workflows/**`

---

## Clasificacion de tareas

| Tipo | Senal |
|------|-------|
| `laravel` | Cambios en backend Laravel, rutas, requests, modelos, migraciones, tests PHP |
| `inertia-vue` | Cambios en paginas, layouts, componentes, composables, estilos o TypeScript |
| `infra` | Docker, entorno, CI, Makefile, bootstrap o variables |
| `memoria` | Cambios en `docs/**`, `.github/**`, `_standard/**`, `context.md` o este archivo |
| `review` | Auditoria de cumplimiento, deuda, riesgos o inconsistencias |
| `reporte` | Resumen de cambios, pruebas, riesgos y proximos pasos |

---

## Loop obligatorio de trabajo

1. Identificar tipo de tarea y areas afectadas.
2. Leer la memoria aplicable en el orden definido arriba.
3. Detectar ambiguedad, colision entre reglas o informacion faltante.
4. Si hay ambiguedad o colision: detenerse y pedir confirmacion antes de editar.
5. Si no hay conflicto: explicar al usuario que se va a hacer y cual sera el primer paso.
6. Explorar el codigo real antes de proponer o aplicar cambios.
7. Aplicar cambios minimos, coherentes y dentro del alcance pedido.
8. Verificar impacto en memoria antes de cerrar.
9. Ejecutar validaciones requeridas segun el tipo de cambio.
10. Cerrar con reporte corto: cambios, validaciones, impacto en memoria y riesgos.

---

## Preflight obligatorio antes de editar

Antes de tocar cualquier archivo, mostrar:
- Archivos de memoria leidos.
- Reglas aplicables.
- Archivos que se van a modificar y objetivo de cada cambio.
- Validaciones finales que se ejecutaran.

---

## Cierre obligatorio

Al finalizar cualquier tarea, mostrar:
- Que cambio.
- Que validaciones se ejecutaron y resultado.
- Si hubo impacto en memoria (`docs/`, `.github/`, `_standard/`, `context.md`).
- Que riesgos o pendientes quedaron.

---

## Reglas de memoria

- `docs/` y `.github/` son reglas del proyecto, no referencia opcional.
- `_standard/` es molde portable; no debe contener logica de negocio de una app concreta.
- `src/AGENTS.md` conserva reglas Laravel Boost y versionado del stack.
- Si cambias un patron, convencion o flujo documentado, evaluar si la memoria necesita actualizarse.
- Si creas un nuevo `context.md`, indexarlo en `docs/guia_IA.md` antes de cerrar.
- No duplicar reglas completas en varios archivos; enlazar a la fuente oficial.

---

## Reglas de ejecucion

- No improvisar endpoints, nombres, permisos ni estructuras.
- No introducir logica de negocio especifica en este template salvo que el usuario la pida.
- No reordenar imports, whitespace ni bloques no relacionados fuera del alcance.
- Para Laravel: preferir convenciones del proyecto y Laravel Boost; ejecutar tests relevantes.
- Para Inertia/Vue: ejecutar lint/format sobre archivos modificados cuando aplique.
- Para infra: validar estructura y comandos documentados.

---

## Regla de evidencia

Cuando el usuario pida seguir este archivo, actuar como lista de control obligatoria.
Si no se leyo alguno de los archivos requeridos para la tarea, decirlo explicitamente antes de editar.
