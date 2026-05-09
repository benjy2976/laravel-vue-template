# Convenciones

## 1. Generales

- **Idioma**: `<!-- IDIOMA_COMENTARIOS -->` en comentarios y documentación; nombres de módulos, clases, funciones, variables, rutas y archivos en `<!-- IDIOMA_CODIGO -->`.
- **Nombres de archivos**: `<!-- CONVENCIÓN_ARCHIVOS -->` (ej. kebab-case para archivos, PascalCase para componentes).
- **Nombres de funciones/métodos**: `<!-- CONVENCIÓN_FUNCIONES -->` (ej. camelCase).
- **Nombres de clases**: `<!-- CONVENCIÓN_CLASES -->` (ej. PascalCase).
- **Constantes**: `<!-- CONVENCIÓN_CONSTANTES -->` (ej. UPPER_SNAKE_CASE).

---

## 2. `<!-- CAPA_1 -->` (ej. Frontend)

<!-- Convenciones específicas de la primera capa tecnológica -->
<!-- Cubrir: estructura de módulos, componentes, stores, rutas, estilos -->

### Estructura de módulos
- `<!-- descripción de dónde viven los módulos -->`

### Componentes
- `<!-- convención de nombres y organización -->`

### Estado y stores
- `<!-- cómo se gestiona el estado -->`

### Rutas
- `<!-- convención de rutas y protección -->`

### Estilos
- `<!-- framework de estilos y reglas de uso -->`

---

## 3. `<!-- CAPA_2 -->` (ej. Backend)

<!-- Convenciones específicas de la segunda capa tecnológica -->
<!-- Cubrir: validaciones, respuestas, autenticación, controladores -->

### Validación
- `<!-- dónde y cómo se valida -->`

### Respuestas de error
- `<!-- estructura de respuesta de error -->`

### Autenticación y autorización
- `<!-- mecanismo de auth y control de permisos -->`

---

## 4. Manejo de errores

### Códigos HTTP recomendados
- `422` → validación y reglas de negocio recuperables
- `403` → autorización / permisos
- `404` → recurso no encontrado
- `409` → conflicto de estado o concurrencia
- `500` → fallos técnicos reales

### Mensajes de error
- Los errores de negocio esperables deben incluir: `message`, `errors` y, si existe, `error_code`.
- No esconder el motivo real detrás de mensajes genéricos.

<!-- Agregar aquí las reglas específicas de severidad visual (toast, alert) si aplica -->

---

## 5. Permisos y autorización

- Patrón de permisos: `<!-- PATRÓN_PERMISOS -->` (ej. `<módulo>.(view|create|edit|delete)`)
- `<!-- reglas de aplicación por capa -->`

---

## 6. Flujo de datos

- `<!-- describir el flujo principal de datos de extremo a extremo -->`
- `<!-- reglas sobre fuente única de verdad -->`

---

## 7. Relaciones y modelos de datos

- `<!-- reglas sobre relaciones entre entidades -->`
- `<!-- cuándo cargar relaciones, cuándo no -->`

---

## 8. Calidad, higiene y cierre

- Al proponer código o cambios, respetar estas convenciones y pedir aprobación antes de aplicarlos.
- Incluir micro-comentarios previos a cada bloque lógico complejo.
- Nombres descriptivos y consistentes.
- Si se detecta una práctica o patrón no documentado, notificar y sugerir actualización.
- **Higiene post-cambio**: antes de cerrar una implementación, revisar y eliminar residuos: variables, importaciones, flags, helpers o ramas de template que ya no se usan.
- Regla práctica de cierre: después de que el cambio funcione, hacer una pasada final preguntando "qué quedó definido pero nunca leído/ejecutado/renderizado".

---

## 9. Formato de commits

<!-- Definir formato. Ejemplo:
- `feat: <descripción>` para funcionalidades nuevas
- `fix: <descripción>` para correcciones
- `docs: <descripción>` para documentación
- `refactor: <descripción>` para refactors sin cambio funcional
- `chore: <descripción>` para tareas de mantenimiento
-->

`<!-- FORMATO_COMMITS -->`

---

## 10. Patrones adicionales

<!-- Agregar aquí patrones específicos del proyecto que no encajan en las secciones anteriores -->
<!-- Ejemplos: helpers compartidos, nomenclatura de computeds, normalización de parámetros -->
