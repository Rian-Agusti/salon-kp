<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorized via middleware
    }

    public function rules(): array
    {
        return [
            'salon_name' => ['required', 'string', 'max:150'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:100'],
            'instagram' => ['nullable', 'string', 'max:100'],
            'facebook' => ['nullable', 'string', 'max:100'],
            'tiktok' => ['nullable', 'string', 'max:100'],
            'google_maps' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($value && !preg_match('/^<iframe\s/', $value)) {
                        $fail('The '.$attribute.' must be a valid iframe embed code.');
                    }
                },
            ],
            'opening_hour' => ['required', 'date_format:H:i'],
            'closing_hour' => ['required', 'date_format:H:i'],
        ];
    }
}
