<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->can('users.store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:'.config('permission.table_names.roles').',name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:'.config('permission.table_names.permissions').',name',
        ];
    }
}
