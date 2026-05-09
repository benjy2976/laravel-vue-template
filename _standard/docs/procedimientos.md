# Procedimientos

## Objetivo
Concentrar los pasos operativos del proyecto: entorno, desarrollo, validación y deploy.
Antes de ejecutar una tarea de desarrollo, leer `AGENT_PROTOCOL.md`.

---

## Entorno y arranque

```bash
# Instalar dependencias
<!-- COMANDO_INSTALAR_DEPS -->

# Levantar el proyecto
<!-- COMANDO_ARRANCAR -->

# Servicios esperados
# <!-- SERVICIO_1 --> en puerto <!-- PUERTO_1 -->
# <!-- SERVICIO_2 --> en puerto <!-- PUERTO_2 -->
```

---

## Desarrollo

```bash
# Modo desarrollo <!-- CAPA_1 -->
<!-- COMANDO_DEV_CAPA_1 -->

# Modo desarrollo <!-- CAPA_2 -->
<!-- COMANDO_DEV_CAPA_2 -->
```

---

## Migraciones y datos base

```bash
# Crear migración
<!-- COMANDO_CREAR_MIGRACION -->

# Ejecutar migraciones
<!-- COMANDO_MIGRAR -->

# Ejecutar seeders / datos iniciales
<!-- COMANDO_SEED -->
```

### Reglas de migraciones
- Crear migraciones nuevas para modificar tablas existentes; no editar las originales ya ejecutadas.
- `<!-- Agregar reglas específicas del motor de base de datos -->`

---

## Validación técnica

### `<!-- CAPA_2 -->` (ej. Backend — tests)

```bash
# Ejecutar toda la suite
<!-- COMANDO_TESTS_TODOS -->

# Ejecutar archivo puntual
<!-- COMANDO_TEST_PUNTUAL --> <ruta/al/test>
```

### `<!-- CAPA_1 -->` (ej. Frontend — lint)

```bash
# Fix automático
<!-- COMANDO_LINT_FIX --> <ruta/al/archivo>

# Verificar sin fix
<!-- COMANDO_LINT --> <ruta/al/archivo>
```

Regla: solo ejecutar lint al cierre del cambio, no entre pasos intermedios del mismo flujo.

---

## Generación de módulos

### `<!-- CAPA_2 -->` nuevo módulo backend
```bash
<!-- PASOS_NUEVO_MODULO_BACKEND -->
```

### `<!-- CAPA_1 -->` nuevo módulo frontend
```bash
<!-- PASOS_NUEVO_MODULO_FRONTEND -->
```

---

## Deploy y caché

```bash
# Build de producción
<!-- COMANDO_BUILD -->

# Limpiar caché
<!-- COMANDO_LIMPIAR_CACHE -->
```

---

## Cierre técnico obligatorio

Antes de declarar una tarea como completa:

1. Revisar si el cambio afecta memoria (`docs/`, `.github/`, `context.md`).
2. Ejecutar validación técnica requerida según el tipo de cambio:
   - `<!-- CAPA_2 -->`: tests necesarios.
   - `<!-- CAPA_1 -->`: lint fix + lint.
3. Si hubo cambios de negocio de un módulo, actualizar su `context.md`.
4. Si se creó un nuevo `context.md`, indexarlo en `docs/guia_IA.md`.
