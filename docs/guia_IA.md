# Guia para la IA

## Punto de entrada operativo

Antes de actuar en cualquier tarea, leer `AGENT_PROTOCOL.md` y seguirlo como checklist. `docs/` y `.github/` son la fuente normativa; `src/AGENTS.md` conserva las reglas Laravel Boost del proyecto.

## Estilo de respuesta

- Idioma: espanol.
- Tono: conciso, directo y con pasos claros.
- Referencias a archivos: rutas relativas desde la raiz del repositorio.
- No inventar datos, endpoints ni estructuras; usar `TODO` o pedir aclaracion.

## Comportamientos transversales

- Aplicar estrictamente la documentacion del proyecto (`docs/`, `.github/`, `AGENT_PROTOCOL.md`).
- Usar `src/AGENTS.md` para reglas de Laravel Boost, paquetes instalados y convenciones Laravel especificas.
- Verificar siempre impacto en memoria. Si aparece una nueva convencion, proponer donde documentarla y esperar aprobacion.
- Mantener el repositorio como template generico: no agregar reglas de negocio especificas, dominios cerrados ni modulos no reutilizables.
- Si hay ambiguedad o conflicto entre documentos, detenerse y pedir confirmacion.
- El conocimiento funcional de cada area vive en su `context.md`; la memoria global solo contiene reglas transversales.

## Flujos base del template

- Autenticacion: Fortify + Inertia, con rutas generadas por Wayfinder.
- Settings: perfil, password, apariencia y two-factor authentication.
- Presentacion: Inertia renderiza paginas Vue desde rutas web Laravel.
- Infraestructura local: Docker Compose con `app`, `web`, `db`, `redis` y `mailpit`.

## Reglas de analisis de memoria

- Revisar reglas una por una y comparar propuestas nuevas contra reglas existentes para evitar redundancia.
- Cuando el usuario apruebe una propuesta, implementar exactamente esa propuesta; no reimaginar soluciones sin volver a pedir aprobacion.
- No reordenar ni tocar lineas no relacionadas fuera del alcance solicitado.
- Si se crea un nuevo `context.md`, indexarlo en esta guia antes de cerrar la tarea.
- Si un area cambia sus reglas funcionales, estados o rutas relevantes, actualizar su `context.md` antes de cerrar.

## Contextos funcionales del template

- Auth: `src/resources/js/pages/auth/context.md`
- Settings: `src/resources/js/pages/settings/context.md`
- Pages/Dashboard: `src/resources/js/pages/context.md`
- Admin base: `src/resources/js/pages/admin/context.md`
