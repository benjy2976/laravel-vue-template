# Contexto: Admin base

## Proposito

Gestionar la base administrativa heredable del template: usuarios, roles, permisos y menu dinamico.

## Actores y permisos

- Administrator: tiene todos los permisos base y puede gestionar usuarios, roles y metadatos de permisos.
- User: rol autenticado generico con acceso al dashboard.

## Entidades y relaciones relevantes

- `User`: usuario autenticado de Laravel/Fortify.
- `Role`: agrupador de permisos.
- `Permission`: capacidad asignable y, opcionalmente, item de menu.
- Relaciones:
  - User many-to-many Role.
  - Role many-to-many Permission.
  - Permission self-reference para jerarquia de menu.

## Estados y transiciones

- Un usuario puede recibir o perder roles.
- Un rol puede recibir o perder permisos.
- Un permiso puede mostrarse u ocultarse del menu mediante metadatos.

## Reglas de negocio

1. Mantener permisos y roles genericos, sin dominios de negocio especificos.
2. No borrar roles de sistema (`admin`, `user`).
3. No borrar permisos base desde la UI; solo actualizar sus metadatos de menu.
4. El menu se deriva de permisos con `is_menu=true` asignados al usuario.
5. Los proyectos derivados pueden agregar permisos nuevos, pero deben documentar el motivo en su contexto.

## Rutas involucradas

- `GET /admin/users`
- `POST /admin/users`
- `PUT /admin/users/{user}`
- `DELETE /admin/users/{user}`
- `GET /admin/roles`
- `POST /admin/roles`
- `PUT /admin/roles/{role}`
- `DELETE /admin/roles/{role}`
- `GET /admin/permissions`
- `PUT /admin/permissions/{permission}`

## UI y rutas

- `src/resources/js/pages/admin/users/Index.vue`
- `src/resources/js/pages/admin/roles/Index.vue`
- `src/resources/js/pages/admin/permissions/Index.vue`
- `src/resources/js/components/AppSidebar.vue`
- `src/resources/js/components/NavMain.vue`

## Errores esperables

- `403` cuando el usuario no tiene el permiso requerido.
- Validaciones de email unico, password y nombres de roles.
- Bloqueo al intentar eliminar el propio usuario o un rol de sistema.

## Pruebas manuales minimas

1. Ejecutar seeders.
2. Iniciar sesion como `test@example.com`.
3. Confirmar que aparece el menu Administration.
4. Crear un usuario con rol `user`.
5. Crear un rol nuevo y asignarle permisos.
6. Editar metadatos de menu de un permiso.
