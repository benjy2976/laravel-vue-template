# Arquitectura del proyecto

## Stack actual

- `<!-- CAPA_1 -->`: `<!-- TECNOLOGÍAS_CAPA_1 -->` (ej. Vite + Vue 3 + Pinia)
- `<!-- CAPA_2 -->`: `<!-- TECNOLOGÍAS_CAPA_2 -->` (ej. Laravel 12, Sanctum, Spatie)
- Base de datos: `<!-- BASE_DE_DATOS -->`
- Infraestructura: `<!-- INFRAESTRUCTURA -->` (ej. Docker, Railway, Vercel)

---

## Capas del sistema

| # | Capa | Responsabilidad | Dónde vive |
|---|------|-----------------|------------|
| 1 | Problema y modelo de negocio | Actores, reglas, estados, endpoints por módulo | `<módulo>/context.md` |
| 2 | Persistencia y dominio | Tablas, modelos, relaciones, servicios | `<!-- RUTA_DOMINIO -->` |
| 3 | Contrato API | Endpoints que exponen el dominio | `<!-- RUTA_API -->` |
| 4 | Estado cliente | Sincronización de datos en el cliente | `<!-- RUTA_ESTADO -->` |
| 5 | Presentación | Módulos, rutas, formularios, tablas, UI | `<!-- RUTA_UI -->` |
| 6 | Validación del cambio | Tests, lint, pruebas manuales | `docs/tests.md`, `docs/procedimientos.md` |

---

## Mapa de carpetas `<!-- CAPA_1 -->`

```
<!-- RUTA_CAPA_1 -->/
├── <!-- carpeta -->         ← <!-- descripción -->
├── <!-- carpeta -->         ← <!-- descripción -->
└── <!-- carpeta -->         ← <!-- descripción -->
```

---

## Mapa de carpetas `<!-- CAPA_2 -->`

```
<!-- RUTA_CAPA_2 -->/
├── <!-- carpeta -->         ← <!-- descripción -->
├── <!-- carpeta -->         ← <!-- descripción -->
└── <!-- carpeta -->         ← <!-- descripción -->
```

---

## Flujo global de datos

1. `<!-- PASO_1 -->`
2. `<!-- PASO_2 -->`
3. `<!-- PASO_3 -->`
4. `<!-- PASO_4 -->`
5. `<!-- PASO_5 -->`

---

## Principios de diseño

- El negocio específico de cada módulo no se documenta globalmente; vive en su `context.md`.
- `<!-- PRINCIPIO_2 -->`
- `<!-- PRINCIPIO_3 -->`

---

## Componentes y helpers compartidos

<!-- Listar componentes o helpers transversales -->
<!-- Formato: - `ruta/al/componente`: descripción de su propósito -->

---

## Dónde vive cada tipo de conocimiento

| Conocimiento | Archivo |
|--------------|---------|
| Reglas globales y técnicas | `docs/convenciones.md` |
| Procedimientos operativos | `docs/procedimientos.md` |
| Arquitectura y mapa del sistema | `docs/arquitectura.md` (este archivo) |
| Entorno y variables | `docs/entorno.md` |
| Contrato API transversal | `docs/api.md` |
| Cobertura y validación | `docs/tests.md` |
| Protocolo de trabajo del agente | `AGENT_PROTOCOL.md` |
| Negocio por módulo | `<módulo>/context.md` |
