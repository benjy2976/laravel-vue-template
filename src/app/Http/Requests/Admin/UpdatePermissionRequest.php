<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->hasPermission('permissions.update') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'label' => ['nullable', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:255'],
            'is_menu' => ['boolean'],
            'menu_label' => ['nullable', 'string', 'max:120'],
            'menu_path' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:80'],
            'parent_id' => ['nullable', 'integer', 'exists:permissions,id', Rule::notIn([$this->route('permission')?->id])],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
