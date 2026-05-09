# Agent Protocol

## Rol de este archivo
Punto de entrada operativo para cualquier agente AI que trabaje en este repositorio.
No reemplaza la memoria normativa de `docs/` ni `.github/`; define el orden de lectura, el loop de trabajo y lo que debes mostrar al usuario.
Si una regla de este archivo choca con `docs/` o `.github/`, no asumas: detente, explica el conflicto y pide confirmación.

---

## Orden de lectura obligatorio antes de actuar

### Siempre (toda tarea)
1. Este archivo completo.
2. `docs/guia_IA.md`
3. `.github/copilot-instructions.md`
4. `docs/convenciones.md`
5. `docs/procedimientos.md`

### Si la tarea toca `<!-- CAPA_1 -->` (ej. frontend)
6. `.github/instructions/<!-- CAPA_1 -->.instructions.md`
7. `context.md` de los módulos afectados
8. `docs/context-template.md` si se crea o reestructura un `context.md`

### Si la tarea toca `<!-- CAPA_2 -->` (ej. backend)
6. `.github/instructions/<!-- CAPA_2 -->.instructions.md`
7. `context.md` del módulo afectado

### Si la tarea toca componentes compartidos o UI transversal
6. `docs/<!-- COMPONENTE_GUIA -->.md` si existe guía específica del componente

---

## Clasificación de tareas

| Tipo | Señal |
|------|-------|
| `<!-- CAPA_1 -->` | Cambios en `<!-- RUTA_CAPA_1 -->/**` |
| `<!-- CAPA_2 -->` | Cambios en `<!-- RUTA_CAPA_2 -->/**` |
| `memoria` | Cambios en `docs/**`, `.github/**` o `context.md` |
| `review` | Auditoría de cumplimiento, deuda, riesgos o inconsistencias |
| `reporte` | Resumen de cambios, pruebas, riesgos y próximos pasos |

---

## Loop obligatorio de trabajo

1. Identificar tipo de tarea y módulos afectados.
2. Leer la memoria aplicable en el orden definido arriba.
3. Detectar ambigüedad, colisión entre reglas o información faltante.
4. Si hay ambigüedad o colisión: **detenerse y pedir confirmación antes de editar**.
5. Si no hay conflicto: explicar al usuario qué se va a hacer y cuál será el primer paso.
6. Explorar el código real antes de proponer cambios.
7. Aplicar cambios mínimos, coherentes y dentro del alcance pedido.
8. Verificar impacto en memoria antes de cerrar.
9. Ejecutar validaciones requeridas según el tipo de cambio.
10. Cerrar con reporte corto: cambios, validaciones, riesgos pendientes.

---

## Preflight obligatorio (mostrar antes de editar)

Antes de tocar cualquier archivo, mostrar al usuario:
- Archivos de memoria leídos
- Reglas aplicables a esta tarea
- Archivos que se van a modificar y qué objetivo cumple cada uno
- Validaciones finales que se ejecutarán al cerrar

---

## Cierre obligatorio (mostrar al terminar)

Al finalizar cualquier tarea mostrar:
- Qué cambió
- Qué validaciones se ejecutaron y su resultado
- Si hubo impacto en memoria (`docs/`, `.github/`, `context.md`)
- Qué riesgos o pendientes quedaron

---

## Reglas de memoria

- `docs/` y `.github/` son reglas del proyecto, no referencia opcional.
- Si cambias un patrón, convención o flujo documentado, evalúa si la memoria necesita actualizarse.
- Si creas un nuevo `context.md`, indexarlo en `docs/guia_IA.md` antes de cerrar.
- Si detectas una regla nueva no documentada, proponer dónde agregarla y esperar aprobación.
- No duplicar reglas completas en varios archivos; enlazar a la fuente oficial.

---

## Reglas de ejecución

- No improvisar endpoints, nombres, permisos ni estructuras.
- No cambiar archivos de memoria fuera del alcance pedido, salvo que el cambio actual los haga necesarios y el usuario ya lo haya aprobado.
- No reordenar imports, whitespace ni bloques no relacionados fuera del alcance.
- Al cerrar cambios en `<!-- CAPA_1 -->`: ejecutar lint/format sobre los archivos modificados.
- Al cerrar cambios en `<!-- CAPA_2 -->`: ejecutar los tests necesarios o explicar por qué no se ejecutaron.

---

## Regla de evidencia

Cuando el usuario pida que sigas este archivo, actúa como lista de control obligatoria.
Si no leíste alguno de los archivos requeridos para la tarea, dilo explícitamente antes de editar.
