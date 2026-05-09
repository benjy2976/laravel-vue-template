<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Display users with their assigned roles.
     */
    public function index(Request $request): Response
    {
        $search = trim((string) $request->query('search', ''));

        $users = User::query()
            ->with('roles:id,name,label')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString()
            ->through(fn (User $user): array => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at?->toISOString(),
                'roles' => $user->roles
                    ->map(fn (Role $role): array => [
                        'id' => $role->id,
                        'name' => $role->name,
                        'label' => $role->label,
                    ])
                    ->values(),
            ]);

        return Inertia::render('admin/users/Index', [
            'users' => $users,
            'roles' => Role::query()
                ->orderBy('label')
                ->orderBy('name')
                ->get(['id', 'name', 'label']),
            'filters' => ['search' => $search],
        ]);
    }

    /**
     * Store a new user.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $user->roles()->sync($data['role_ids'] ?? []);

        return back()->with('success', 'User created.');
    }

    /**
     * Update an existing user.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        $payload = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (! empty($data['password'])) {
            $payload['password'] = $data['password'];
        }

        $user->update($payload);
        $user->roles()->sync($data['role_ids'] ?? []);

        return back()->with('success', 'User updated.');
    }

    /**
     * Delete an existing user.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        abort_unless($request->user()?->hasPermission('users.delete'), 403);

        if ($request->user()?->is($user)) {
            return back()
                ->with('error', 'You cannot delete your own account from the user manager.')
                ->withErrors([
                    'user' => 'You cannot delete your own account from the user manager.',
                ]);
        }

        $user->delete();

        return back()->with('success', 'User deleted.');
    }
}
