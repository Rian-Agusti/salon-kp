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
                // If it's a customer (not an admin creating it for them), we might want to say "layanan" only,
                // but the prompt asked to keep it flexible for admin. So we just ensure at least one is selected.
                // However, since we removed products and promotions from customer view,
                // if they submit nothing, it means they didn't select a service.
                $validator->errors()->add('general', 'Harap pilih minimal satu layanan, produk, atau promo.');
            }
        });
    }
}
