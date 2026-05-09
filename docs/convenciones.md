# Convenciones

## 1. Generales

- Idioma: documentacion y comentarios en espanol; nombres de clases, metodos, variables, archivos tecnicos y rutas en ingles.
- Mantener ASCII por defecto en codigo y documentacion nueva. Textos visibles de UI pueden usar el idioma que defina el producto final.
- No agregar logica de negocio especifica al template base.
- Nombres descriptivos antes que abreviaturas.
- Respetar la estructura existente; no crear carpetas base nuevas sin aprobacion.

## 2. Laravel

- Seguir `src/AGENTS.md` para reglas Laravel Boost, versiones y convenciones del ecosistema.
- Rutas web en `src/routes/**`; preferir rutas nombradas.
- Controllers en `src/app/Http/Controllers/**`.
- Form Requests en `src/app/Http/Requests/**` cuando la validacion sea reutilizable o tenga reglas propias.
- Modelos en `src/app/Models/**` con relaciones Eloquent tipadas.
- Migraciones nuevas para cambiar tablas existentes; no editar migraciones ya ejecutadas si el proyecto consumidor ya esta vivo.
- Usar config (`config(...)`) en codigo de aplicacion; no usar `env()` fuera de archivos de configuracion.
- Para errores esperables, devolver/propagar mensajes claros y validables por Inertia.

## 3. Inertia/Vue

- Paginas Inertia en `src/resources/js/pages/**`.
- Layouts en `src/resources/js/layouts/**`.
- Componentes compartidos en `src/resources/js/components/**`.
- Composables en `src/resources/js/composables/**` con prefijo `use`.
- Componentes Vue en PascalCase.
- Preferir imports con alias `@/` cuando apunten a `resources/js`.
- Usar Wayfinder (`src/resources/js/routes/**` y `src/resources/js/actions/**`) cuando exista helper generado.
- Mantener formularios con `<Form>` de Inertia o `useForm` segun el patron del archivo vecino.
- No duplicar parseo de errores en cada componente si puede centralizarse.

## 4. UI y estilos

- El template combina Bootstrap y utilidades existentes; seguir el estilo de archivos vecinos.
- Usar componentes compartidos antes de crear uno nuevo.
- Evitar estilos inline salvo casos puntuales y justificados.
- Los componentes genericos deben evitar textos o reglas de negocio cerradas.

## 5. Autenticacion y settings

- Auth base: Fortify + Inertia.
- Two-factor authentication usa el flujo existente de Fortify.
- Settings se organiza por paginas bajo `src/resources/js/pages/settings/**` y rutas en `src/routes/settings.php`.
- No cambiar middleware de auth/verified/password.confirm sin revisar rutas y tests relacionados.

## 6. Tests y calidad

- Backend: Pest/PHPUnit.
- PHP style: Pint.
- Frontend: Prettier y ESLint.
- Validar solo el alcance necesario cuando el cambio sea pequeno; ampliar cuando toque reglas compartidas, auth, settings o infraestructura.

## 7. Memoria y contextos

- Todo modulo funcional nuevo debe tener `context.md`.
- El `context.md` documenta proposito, actores, rutas, reglas, errores esperables y pruebas manuales minimas.
- Si se crea un `context.md`, indexarlo en `docs/guia_IA.md`.
- No duplicar reglas globales dentro del contexto; enlazar a `docs/convenciones.md` cuando aplique.

## 8. Higiene de cierre

- Eliminar imports, variables, flags, helpers y ramas de template que no se usen.
- No dejar codigo preparado para una fase futura si no participa del flujo actual.
- Antes de cerrar, revisar: "que quedo definido pero nunca leido, ejecutado o renderizado".

## 9. Commits

Formato recomendado:
- `feat: <descripcion>` para funcionalidades nuevas.
- `fix: <descripcion>` para correcciones.
- `docs: <descripcion>` para documentacion.
- `refactor: <descripcion>` para refactors sin cambio funcional.
- `chore: <descripcion>` para mantenimiento.
