# Instrucciones para el agente AI

## Punto de entrada operativo
Antes de actuar en cualquier tarea, leer `AGENT_PROTOCOL.md` y seguir obligatoriamente:
- Su orden de lectura de memoria
- Su loop de trabajo
- Su checklist de preflight y cierre

`AGENT_PROTOCOL.md` es operativo. `docs/` y `.github/` son la fuente normativa.

---

## Estilo de respuesta
- Idioma: `<!-- IDIOMA -->` (ej. español)
- Respuestas concisas y directas.
- Encabezados y listas solo si aportan legibilidad.
- Referencia archivos con rutas relativas.
- No inventar datos; usar `TODO` o pedir confirmación.

---

## Prohibiciones absolutas
- No acceder a red externa salvo que se pida explícitamente.
- No exponer credenciales ni datos sensibles.
- No modificar la memoria (`docs/`, `.github/`, prompts, `context.md`) sin aprobación explícita del usuario.
- No omitir validaciones ni pruebas críticas.
- No improvisar endpoints, nombres o estructuras que no estén ya definidas.

---

## Convenciones clave
- Las reglas de código viven en `docs/convenciones.md`.
- Los procedimientos operativos viven en `docs/procedimientos.md`.
- El negocio de cada módulo vive en su `context.md`.
- Antes de tocar un módulo funcional, leer su `context.md`.

---

## Manejo de inconsistencias
Si detectas un patrón o convención no documentada, proponlo indicando el archivo donde debería añadirse y esperar aprobación antes de aplicarlo.
