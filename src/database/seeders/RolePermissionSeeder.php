<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Seed generic roles, permissions and menu metadata.
     */
    public function run(): void
    {
        $dashboard = Permission::query()->updateOrCreate(
            ['name' => 'dashboard.view'],
            [
                'label' => 'View dashboard',
                'description' => 'Access the authenticated dashboard',
                'is_system' => true,
                'is_menu' => true,
                'menu_label' => 'Dashboard',
                'menu_path' => '/dashboard',
                'icon' => 'LayoutGrid',
                'sort_order' => 10,
            ],
        );

        $administration = Permission::query()->updateOrCreate(
            ['name' => 'administration.view'],
            [
                'label' => 'View administration',
                'description' => 'Access the administration menu group',
                'is_system' => true,
                'is_menu' => true,
                'menu_label' => 'Administration',
                'menu_path' => '#',
                'icon' => 'ShieldCheck',
                'sort_order' => 90,
            ],
        );

        $definitions = [
            ['users.view', 'View users', true, 'Users', '/admin/users', 'Users', 10],
            ['users.create', 'Create users', false, null, null, null, 0],
            ['users.update', 'Update users', false, null, null, null, 0],
            ['users.delete', 'Delete users', false, null, null, null, 0],
            ['roles.view', 'View roles', true, 'Roles', '/admin/roles', 'Shield', 20],
            ['roles.create', 'Create roles', false, null, null, null, 0],
            ['roles.update', 'Update roles', false, null, null, null, 0],
            ['roles.delete', 'Delete roles', false, null, null, null, 0],
            ['permissions.view', 'View permissions', true, 'Permissions', '/admin/permissions', 'KeyRound', 30],
            ['permissions.update', 'Update permission metadata', false, null, null, null, 0],
        ];

        $permissions = collect([$dashboard, $administration]);

        foreach ($definitions as [$name, $label, $isMenu, $menuLabel, $menuPath, $icon, $sortOrder]) {
            $permissions->push(Permission::query()->updateOrCreate(
                ['name' => $name],
                [
                    'label' => $label,
                    'description' => $label,
                    'is_system' => true,
                    'is_menu' => $isMenu,
                    'menu_label' => $menuLabel,
                    'menu_path' => $menuPath,
                    'icon' => $icon,
                    'parent_id' => $isMenu ? $administration->id : null,
                    'sort_order' => $sortOrder,
                ],
            ));
        }

        $admin = Role::query()->updateOrCreate(
            ['name' => 'admin'],
            [
                'label' => 'Administrator',
                'description' => 'Full access to the template administration tools',
                'is_system' => true,
            ],
        );

        $user = Role::query()->updateOrCreate(
            ['name' => 'user'],
            [
                'label' => 'User',
                'description' => 'Default authenticated user role',
                'is_system' => true,
            ],
        );

        $admin->permissions()->sync($permissions->pluck('id'));
        $user->permissions()->sync([$dashboard->id]);
    }
}
