# Guía para la IA

## Punto de entrada operativo
Antes de actuar en cualquier tarea, leer `AGENT_PROTOCOL.md` y seguirlo como checklist. `docs/` y `.github/` son la fuente normativa; `AGENT_PROTOCOL.md` es el operativo.

---

## Estilo de respuesta
- Idioma: `<!-- IDIOMA -->` (ej. español)
- Tono: conciso, directo, con pasos claros.
- Referencias a archivos: rutas relativas.
- No inventar datos; usar `TODO` o pedir aclaración.

---

## Comportamientos transversales

- Aplicar estrictamente toda la documentación del proyecto (`docs/`, `.github/`). Si hay duda o conflicto, preguntar antes de cambiar.
- Verificar siempre impacto en memoria. Si hay nuevas convenciones o patrones, proponer actualización y esperar aprobación.
- Para tareas de código, añadir micro-comentarios de pasos previos en bloques complejos.
- No inventar endpoints ni datos; usar `TODO` o pedir aclaración.
- El negocio y modelo de negocio por módulo vive en `context.md`; no duplicarlo en la memoria global salvo reglas realmente transversales.

---

## Flujos críticos del sistema
<!-- Documentar aquí los flujos que el agente debe respetar sin alterar -->
<!-- Ejemplo: autenticación, gestión de permisos, flujo de estados de entidades clave -->

- `<!-- FLUJO_1 -->`: `<!-- descripción -->`
- `<!-- FLUJO_2 -->`: `<!-- descripción -->`

---

## Reglas de análisis de memoria

- Al revisar reglas en la memoria, hacerlo una a una y comparar ideas nuevas también una a una para posicionarlas correctamente y evitar redundancias.
- Cuando el usuario apruebe una propuesta de cambio, implementar exactamente esa propuesta; no reimaginar soluciones distintas sin volver a pedir aprobación.
- No reordenar ni tocar líneas no relacionadas (imports, whitespace) fuera del alcance solicitado; si el cambio es necesario, pedir aprobación.
- Antes de ejecutar una tarea, leer `AGENT_PROTOCOL.md` y luego los archivos de memoria relevantes y aplicar **todas** las reglas que apliquen, sin omitir ninguna aunque parezca obvia.
- Si hay ambigüedad o reglas potencialmente en conflicto, detenerse y pedir confirmación; no asumir.
- Antes de incluir una regla nueva, verificar colisiones con las reglas existentes; de encontrarlas, consultar al usuario.
- Si se crea un nuevo `context.md`, indexarlo en este archivo (sección de contextos) antes de cerrar la tarea.
- Si un módulo cambia sus reglas de negocio, estados o endpoints relevantes, actualizar primero su `context.md` antes de cerrar la tarea.

---

## Contextos de módulos (árbol)
<!-- Agregar una entrada por cada módulo funcional real -->
<!-- Formato: - <Namespace/Módulo>: `<ruta/al/context.md>` -->

<!-- Ejemplo:
- Admin/Users: `src/modules/admin/users/context.md`
- Store/Products: `src/modules/store/products/context.md`
-->
