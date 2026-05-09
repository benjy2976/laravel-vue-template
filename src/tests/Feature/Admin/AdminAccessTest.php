<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(function () {
    $this->seed(RolePermissionSeeder::class);
});

test('users without admin permissions cannot access user management', function () {
    $user = User::factory()->create();
    $role = Role::query()->where('name', 'user')->firstOrFail();
    $user->roles()->sync([$role->id]);

    $this
        ->actingAs($user)
        ->get(route('admin.users.index'))
        ->assertForbidden();
});

test('admin users can access base administration pages', function () {
    $user = User::factory()->create();
    $role = Role::query()->where('name', 'admin')->firstOrFail();
    $user->roles()->sync([$role->id]);

    $this->actingAs($user)->get(route('admin.users.index'))->assertOk();
    $this->actingAs($user)->get(route('admin.roles.index'))->assertOk();
    $this->actingAs($user)->get(route('admin.permissions.index'))->assertOk();
});

test('admin users can create roles and users', function () {
    $admin = User::factory()->create();
    $adminRole = Role::query()->where('name', 'admin')->firstOrFail();
    $admin->roles()->sync([$adminRole->id]);

    $this
        ->actingAs($admin)
        ->post(route('admin.roles.store'), [
            'name' => 'manager',
            'label' => 'Manager',
            'description' => 'Generic project manager',
            'permission_ids' => [],
        ])
        ->assertRedirect();

    expect(Role::query()->where('name', 'manager')->exists())->toBeTrue();

    $role = Role::query()->where('name', 'user')->firstOrFail();

    $this
        ->actingAs($admin)
        ->post(route('admin.users.store'), [
            'name' => 'Template User',
            'email' => 'template-user@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role_ids' => [$role->id],
        ])
        ->assertRedirect();

    expect(User::query()->where('email', 'template-user@example.com')->exists())->toBeTrue();
});
