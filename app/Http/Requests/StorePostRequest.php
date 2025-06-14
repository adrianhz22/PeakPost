<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|min:10',
            'body' => 'required|string|min:50',
            'image' => 'required|image',
            'province' => 'required|string',
            'difficulty' => 'required|string',
            'longitude' => 'required|numeric|min:0|max:10000',
            'altitude' => 'nullable|numeric|min:0|max:10000',
            'duration_hours' => 'required|integer|min:0',
            'duration_minutes' => 'required|integer|min:0|max:59',
            'track' => 'nullable|file|mimes:xml,kml',
        ];
    }
}
