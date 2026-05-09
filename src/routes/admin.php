<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function (): void {
        Route::get('users', [UserController::class, 'index'])
            ->middleware('permission:users.view')
            ->name('users.index');
        Route::post('users', [UserController::class, 'store'])
            ->middleware('permission:users.create')
            ->name('users.store');
        Route::put('users/{user}', [UserController::class, 'update'])
            ->middleware('permission:users.update')
            ->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])
            ->middleware('permission:users.delete')
            ->name('users.destroy');

        Route::get('roles', [RoleController::class, 'index'])
            ->middleware('permission:roles.view')
            ->name('roles.index');
        Route::post('roles', [RoleController::class, 'store'])
            ->middleware('permission:roles.create')
            ->name('roles.store');
        Route::put('roles/{role}', [RoleController::class, 'update'])
            ->middleware('permission:roles.update')
            ->name('roles.update');
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])
            ->middleware('permission:roles.delete')
            ->name('roles.destroy');

        Route::get('permissions', [PermissionController::class, 'index'])
            ->middleware('permission:permissions.view')
            ->name('permissions.index');
        Route::put('permissions/{permission}', [PermissionController::class, 'update'])
            ->middleware('permission:permissions.update')
            ->name('permissions.update');
    });
