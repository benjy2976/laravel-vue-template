<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'quote' => ['message' => trim($message), 'author' => trim($author)],
            'auth' => $this->authPayload($request),
            'flash' => $this->flashPayload($request),
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
        ];
    }

    /**
     * Build the shared authenticated user payload.
     *
     * @return array<string, mixed>
     */
    private function authPayload(Request $request): array
    {
        $user = $request->user();

        if (! $user instanceof User) {
            return [
                'user' => null,
                'roles' => [],
                'permissions' => [],
                'menu' => [],
            ];
        }

        $permissions = $user->resolvedPermissions();

        return [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at?->toISOString(),
                'created_at' => $user->created_at?->toISOString(),
                'updated_at' => $user->updated_at?->toISOString(),
            ],
            'roles' => $user->roles
                ->map(fn (Role $role): string => $role->name)
                ->values(),
            'permissions' => $permissions
                ->map(fn (Permission $permission): string => $permission->name)
                ->values(),
            'menu' => Permission::buildMenu($permissions),
        ];
    }

    /**
     * Share one-time feedback messages with the frontend.
     *
     * @return array<string, mixed>
     */
    private function flashPayload(Request $request): array
    {
        $messages = [
            'success' => $request->session()->get('success'),
            'error' => $request->session()->get('error'),
            'warning' => $request->session()->get('warning'),
            'info' => $request->session()->get('info'),
            'status' => $request->session()->get('status'),
        ];

        $hasMessage = collect($messages)
            ->filter(fn (mixed $message): bool => filled($message))
            ->isNotEmpty();

        return [
            ...$messages,
            'id' => $hasMessage ? (string) Str::uuid() : null,
        ];
    }
}
