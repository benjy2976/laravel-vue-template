# Estándar de Artefactos para Proyectos con IA

Esta carpeta contiene las plantillas del estándar de trabajo. No es parte del proyecto; es el molde portable para inicializar el sistema de memoria y contexto en cualquier repositorio.

## Cómo usar estas plantillas

### Proyecto nuevo
1. Copiar los 8 archivos obligatorios al proyecto (ver lista abajo).
2. Ejecutar el prompt `inicializar_proyecto.prompt.md` — el agente leerá el proyecto y completará las plantillas.
3. Revisar y aprobar los borradores generados.
4. A partir de ese punto, trabajar con los prompts de tarea.

### Proyecto existente sin estándar
1. Copiar los archivos que falten.
2. Ejecutar `inicializar_proyecto.prompt.md` — el agente detectará qué existe, qué falta y qué mejorar.
3. Aprobar los cambios sección por sección.

### Proyecto existente con estándar parcial
1. Ejecutar `inicializar_proyecto.prompt.md` apuntando a los archivos que quieres revisar.
2. El agente auditará el estado y propondrá mejoras sin borrar lo que ya funciona.

---

## Archivos obligatorios (mínimo de cualquier proyecto)

| Archivo | Destino en el proyecto | Propósito |
|---------|------------------------|-----------|
| `AGENT_PROTOCOL.md` | `./AGENT_PROTOCOL.md` | Loop de trabajo del agente |
| `docs/guia_IA.md` | `./docs/guia_IA.md` | Reglas de comportamiento + índice de módulos |
| `docs/convenciones.md` | `./docs/convenciones.md` | Nombres, estilos, patrones |
| `docs/procedimientos.md` | `./docs/procedimientos.md` | Comandos operativos |
| `docs/arquitectura.md` | `./docs/arquitectura.md` | Mapa del sistema |
| `docs/entorno.md` | `./docs/entorno.md` | Variables y servicios |
| `.github/copilot-instructions.md` | `./.github/copilot-instructions.md` | Config del agente AI |
| `.github/prompts/base_universal.prompt.md` | `./.github/prompts/base_universal.prompt.md` | Activador mínimo de sesión |

## Archivos condicionales

| Condición | Archivo |
|-----------|---------|
| Módulos funcionales existen | `docs/context-template.md` → crear `<módulo>/context.md` por módulo |
| Múltiples capas tecnológicas | `.github/instructions/<capa>.instructions.md` |
| Tareas AI recurrentes por tipo | Prompts adicionales de `.github/prompts/` |

---

## Regla de oro

Cada pieza de conocimiento vive en un solo lugar. Si una regla aparece en dos archivos, uno es normativo y el otro referencia al primero. Nunca duplicar.
