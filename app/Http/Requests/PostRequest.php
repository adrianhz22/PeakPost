<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'slug' => 'nullable|string',
            'body' => 'required|string|min:50',
            'image' => 'required|string',
            'province' => 'required|string',
            'difficulty' => 'required|string',
            'longitude' => 'required|numeric',
            'altitude' => 'nullable|numeric',
            'time' => 'nullable|date-format:H:i:s',
            'track' => 'nullable|file|mimes:xml,kml',

        ];
    }
}
