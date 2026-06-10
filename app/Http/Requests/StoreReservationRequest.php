<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Already authenticated via middleware
    }

    public function rules(): array
    {
        return [
            'services' => ['nullable', 'array'],
            'services.*' => ['exists:services,id'],
            'products' => ['nullable', 'array'],
            'products.*.id' => ['exists:products,id'],
            'products.*.quantity' => ['integer', 'min:1'],
            'promotions' => ['nullable', 'array'],
            'promotions.*' => ['exists:promotions,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $services = $this->input('services', []);
            $products = array_filter($this->input('products', []), fn($p) => isset($p['id']) && $p['quantity'] > 0);
            $promotions = $this->input('promotions', []);

            if (empty($services) && empty($products) && empty($promotions)) {
                $validator->errors()->add('general', 'Harap pilih minimal satu layanan, produk, atau promo.');
            }
        });
    }
}
