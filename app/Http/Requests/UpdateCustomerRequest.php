<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email,'.$this->route('customer')->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'birth_date' => ['nullable', 'date'],
            'member_until' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'type' => ['required', 'in:online,offline'],
            // is_active will be handled directly in the controller via has() since it's a checkbox
        ];
    }
}
