<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PermissionController extends Controller
{
    /**
     * Display permissions and menu metadata.
     */
    public function index(): Response
    {
        return Inertia::render('admin/permissions/Index', [
            'permissions' => Permission::query()
                ->with('parent:id,name,label,menu_label')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get()
                ->map(fn (Permission $permission): array => [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'label' => $permission->label,
                    'description' => $permission->description,
                    'is_system' => $permission->is_system,
                    'is_menu' => $permission->is_menu,
                    'menu_label' => $permission->menu_label,
                    'menu_path' => $permission->menu_path,
                    'icon' => $permission->icon,
                    'parent_id' => $permission->parent_id,
                    'parent' => $permission->parent ? [
                        'id' => $permission->parent->id,
                        'name' => $permission->parent->name,
                        'label' => $permission->parent->label,
                        'menu_label' => $permission->parent->menu_label,
                    ] : null,
                    'sort_order' => $permission->sort_order,
                ]),
            'menuParents' => Permission::query()
                ->where('is_menu', true)
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->get(['id', 'name', 'label', 'menu_label']),
        ]);
    }

    /**
     * Update menu metadata for an existing permission.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $data = $request->validated();

        $permission->update([
            'label' => $data['label'] ?? null,
            'description' => $data['description'] ?? null,
            'is_menu' => (bool) ($data['is_menu'] ?? false),
            'menu_label' => $data['menu_label'] ?? null,
            'menu_path' => $data['menu_path'] ?? null,
            'icon' => $data['icon'] ?? null,
            'parent_id' => $data['parent_id'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return back()->with('success', 'Permission metadata updated.');
    }
}
