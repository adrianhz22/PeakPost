<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:20',
            'last_name' => 'nullable|string|min:3|max:40',
            'username' => 'required|string|min:3|max:20|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    public static function creationRules(): array
    {
        return [
            'name' => 'required|string|min:3|max:20',
            'last_name' => 'nullable|string|min:3|max:40',
            'username' => 'required|string|min:3|max:20|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }
}
