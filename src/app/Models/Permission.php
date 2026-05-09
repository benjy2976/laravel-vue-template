<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'label',
        'description',
        'is_system',
        'is_menu',
        'menu_label',
        'menu_path',
        'icon',
        'parent_id',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_system' => 'boolean',
            'is_menu' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Roles that include this permission.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Parent menu permission.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Child menu permissions.
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Build a generic menu tree from a permission collection.
     *
     * @param  Collection<int, Permission>  $permissions
     * @return array<int, array<string, mixed>>
     */
    public static function buildMenu(Collection $permissions): array
    {
        $items = $permissions
            ->filter(fn (Permission $permission): bool => $permission->is_menu)
            ->sortBy([
                ['sort_order', 'asc'],
                ['menu_label', 'asc'],
            ])
            ->values();

        $childrenByParent = $items
            ->filter(fn (Permission $permission): bool => $permission->parent_id !== null)
            ->groupBy('parent_id');

        return $items
            ->filter(fn (Permission $permission): bool => $permission->parent_id === null)
            ->map(fn (Permission $permission): array => self::toMenuItem($permission, $childrenByParent->get($permission->id, collect())))
            ->values()
            ->all();
    }

    /**
     * Convert one permission into a menu item payload.
     *
     * @param  Collection<int, Permission>  $children
     * @return array<string, mixed>
     */
    private static function toMenuItem(Permission $permission, Collection $children): array
    {
        return [
            'title' => $permission->menu_label ?: $permission->label ?: $permission->name,
            'href' => $permission->menu_path ?: '#',
            'icon' => $permission->icon,
            'children' => $children
                ->sortBy([
                    ['sort_order', 'asc'],
                    ['menu_label', 'asc'],
                ])
                ->map(fn (Permission $child): array => self::toMenuItem($child, collect()))
                ->values()
                ->all(),
        ];
    }
}
