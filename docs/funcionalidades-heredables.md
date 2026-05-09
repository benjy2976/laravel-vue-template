# Evaluacion de funcionalidades heredables para el template

## Criterios de evaluacion

Escala usada:

- `Alta`, `Media`, `Baja`.
- En `Reusabilidad`, `Impacto base` y `Mantenibilidad`, una valoracion alta es positiva.
- En `Acoplamiento negocio`, `Costo adaptacion` y `Riesgo`, una valoracion baja es positiva.
- `Adecuacion requerida` mide cuanto trabajo hace falta para llevar la funcionalidad al template sin contaminarlo con logica de negocio.

## Tabla de funcionalidades

| Funcionalidad | Existe en template | Necesita adecuarse | Adecuacion requerida | Reusabilidad | Acoplamiento negocio | Costo adaptacion | Impacto base | Riesgo | Mantenibilidad | Recomendacion | Prioridad | Motivo |
|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Login/Auth | Si, base Fortify + Inertia | Si | Media | Alta | Bajo | Medio | Alta | Medio | Alta | Migrar parcialmente / reforzar | Alta | El template ya tiene login, registro, reset, 2FA y verificacion. Conviene mejorar documentacion, UX y patrones, no copiar arquitecturas SPA de proyectos derivados. |
| Roles y permisos | Si, base heredable propia | Si | Baja/Media | Alta | Bajo | Medio | Alta | Medio | Media/Alta | Implementado; extender por proyecto | Completada | Existe RBAC generico con roles `admin`/`user`, permisos base y middleware `permission`. Los proyectos derivados deben agregar permisos propios sin editar la semantica base. |
| Menus dinamicos por permiso | Si, desde metadatos de permisos | Si | Baja/Media | Alta | Bajo | Medio | Alta | Medio | Media/Alta | Implementado; ajustar metadatos por proyecto | Completada | El menu se deriva de `is_menu`, `menu_label`, `menu_path`, `icon`, `parent_id`, `sort_order` y del conjunto de permisos del usuario. |
| Gestion de usuarios | Si, CRUD administrativo base | Si | Baja/Media | Alta | Bajo | Medio | Alta | Medio | Media/Alta | Implementado; extender campos con cuidado | Completada | La UI administra nombre, email, password y roles. Campos como estado, avatar u organizacion deben agregarse solo cuando el proyecto lo requiera. |
| Gestion de roles | Si, CRUD administrativo base | Si | Baja/Media | Alta | Bajo | Medio | Alta | Medio | Media/Alta | Implementado; conservar roles de sistema | Completada | Permite crear/editar roles y asignar permisos, bloqueando eliminacion de roles de sistema. No incluye roles de negocio. |
| Gestion de permisos | Si, listado y metadatos de menu | Si | Media | Alta | Bajo/Medio | Medio | Alta | Medio/Alto | Media | Implementado con alcance controlado | Completada | El template permite editar metadatos de permisos, pero no crear/eliminar permisos desde UI para evitar romper autorizacion base. |
| Layout administrativo con sidebar/topbar | Si, con menu dinamico | Si | Baja | Alta | Bajo | Bajo/Medio | Alta | Bajo/Medio | Alta | Implementado; mantener generico | Completada | `AppSidebar` consume `auth.menu` y `NavMain` soporta grupos anidados sin imponer secciones de negocio. |
| Toasts globales | No como servicio global estandar | Si | Baja/Media | Alta | Bajo | Bajo | Alta | Bajo | Alta | Migrar adaptado | Alta | Bajo acoplamiento y mucha utilidad para formularios, acciones CRUD y errores. Debe adaptarse a Inertia/Vue actual. |
| Helper de errores HTTP/forms | Parcial, existe `InputError` y errores de Inertia | Si | Media | Alta | Bajo | Medio | Alta | Bajo/Medio | Alta | Migrar adaptado | Alta | Conviene centralizar mensajes de error, severidad y errores generales. Debe integrarse con `<Form>`/`useForm` de Inertia. |
| Tabla/listado reusable | No | Si | Media | Alta | Bajo | Medio | Media/Alta | Medio | Media | Migrar adaptado | Media/Alta | Acelera CRUDs. Debe ser generica y compatible con el sistema visual del template, no una copia exacta si el estilo diverge. |
| Paginacion/filtros estandar | No | Si | Media | Alta | Bajo | Medio | Media/Alta | Medio | Media | Migrar como patron base | Media/Alta | Reusable para administracion. Mejor como composable/patron simple antes que framework rigido. |
| FileDropzone/uploads | No | Si | Media | Media/Alta | Bajo | Medio | Media | Bajo/Medio | Media | Migrar como opcional | Media | Util en muchos proyectos, pero no universal. Debe quedar generico y sin modelo de archivos de negocio. |
| Notificaciones in-app | No | Si | Alta | Media/Alta | Medio | Alto | Media/Alta | Alto | Media | Migrar base minima opcional | Media | Tiene valor transversal, pero requiere tablas, endpoints, UI y decisiones de retencion. Empezar con notificaciones simples, sin tipos de negocio. |
| Push notifications | No | Si | Alta | Media | Medio | Alto | Media | Alto | Media/Baja | No migrar en primera fase | Baja/Media | Agrega VAPID, service worker, permisos navegador y edge cases. Mejor como modulo opcional posterior. |
| Auditoria / activity log | No | Si | Media/Alta | Alta | Bajo/Medio | Medio/Alto | Media/Alta | Medio | Media | Disenar generico, no copiar | Media | Muy reusable, pero debe decidirse con paquete/patron estable y sin eventos de negocio especificos. |
| Backups por modelo | No | Si | Alta | Media | Alto si se copia desde un proyecto concreto | Alto | Media | Alto | Media/Baja | No migrar todavia | Baja | Depende de tablas reales del proyecto. En el template solo debe quedar documentado el patron para proyectos derivados. |
| Dashboard base | Si, placeholder | Si | Baja | Alta | Bajo | Bajo | Media | Bajo | Alta | Adecuar minimo | Media | Conviene mantenerlo generico y extensible, con slots/cards neutros o pantalla inicial limpia. |
| CRUD generator / patron de modulo | Parcial, existe prompt `nuevo_modulo` y procedimientos | Si | Baja/Media | Alta | Bajo | Medio | Media/Alta | Medio | Alta | Fortalecer como documentacion/prompt | Media | Mejor como guia y prompt que como generador rigido. Evita imponer estructura de negocio demasiado temprano. |
| Cambio obligatorio de password / recordatorios | No | Si | Media | Media | Medio/Alto | Medio | Media | Medio | Media | No migrar tal cual | Baja | Es una regla de seguridad posible, pero no universal. Puede quedar como receta opcional, no como flujo base. |
| pmsg/core/stores SPA | No | No aplica | Alta | Baja para este template | Alto | Alto | Baja | Alto | Baja | No migrar | Baja | Pertenece a un stack SPA distinto. El template actual usa Inertia + Wayfinder, por lo que seria una direccion arquitectonica incompatible. |

## Orden recomendado de implementacion

1. **Base administrativa heredable**
   - Roles y permisos.
   - Gestion de usuarios.
   - Gestion de roles.
   - Gestion de permisos.
   - Menus dinamicos por permiso.
   - Estado: implementado como base generica del template.

2. **UX transversal**
   - Layout administrativo ajustado.
   - Toasts globales.
   - Helper de errores HTTP/forms.

3. **CRUD toolkit**
   - Tabla/listado reusable.
   - Paginacion/filtros estandar.
   - Patron de modulo via prompts/procedimientos.

4. **Modulos opcionales**
   - FileDropzone/uploads.
   - Notificaciones in-app base.
   - Auditoria/activity log.

5. **No migrar por ahora**
   - Push notifications.
   - Backups por modelo.
   - Cambio obligatorio de password tal cual.
   - pmsg/core/stores.

## Recomendacion tecnica general

La primera migracion funcional deberia ser **roles/permisos + menus dinamicos + gestion de usuarios**. Esa combinacion convierte el template en una base administrativa heredable sin amarrarlo a un dominio de negocio.

La segunda migracion deberia ser **UX transversal**: layout, toasts y errores. Estas piezas reducen duplicacion desde el primer proyecto derivado y tienen bajo acoplamiento.
