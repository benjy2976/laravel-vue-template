<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RoleController extends Controller
{
    /**
     * Display roles and permissions.
     */
    public function index(): Response
    {
        return Inertia::render('admin/roles/Index', [
            'roles' => Role::query()
                ->with('permissions:id,name,label')
                ->orderBy('label')
                ->orderBy('name')
                ->get()
                ->map(fn (Role $role): array => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'label' => $role->label,
                    'description' => $role->description,
                    'is_system' => $role->is_system,
                    'permissions' => $role->permissions
                        ->map(fn (Permission $permission): array => [
                            'id' => $permission->id,
                            'name' => $permission->name,
                            'label' => $permission->label,
                        ])
                        ->values(),
                ]),
            'permissions' => Permission::query()
                ->orderBy('name')
                ->get(['id', 'name', 'label', 'description']),
        ]);
    }

    /**
     * Store a new role.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $role = Role::query()->create([
            'name' => $data['name'],
            'label' => $data['label'] ?: $data['name'],
            'description' => $data['description'] ?? null,
            'is_system' => false,
        ]);

        $role->permissions()->sync($data['permission_ids'] ?? []);

        return back()->with('success', 'Role created.');
    }

    /**
     * Update an existing role.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $data = $request->validated();

        $role->update([
            'name' => $role->is_system ? $role->name : $data['name'],
            'label' => $data['label'] ?: $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        $role->permissions()->sync($data['permission_ids'] ?? []);

        return back()->with('success', 'Role updated.');
    }

    /**
     * Delete an existing role.
     */
    public function destroy(Request $request, Role $role): RedirectResponse
    {
        abort_unless($request->user()?->hasPermission('roles.delete'), 403);

        if ($role->is_system) {
            return back()
                ->with('error', 'System roles cannot be deleted.')
                ->withErrors([
                    'role' => 'System roles cannot be deleted.',
                ]);
        }

        $role->delete();

        return back()->with('success', 'Role deleted.');
    }
}
