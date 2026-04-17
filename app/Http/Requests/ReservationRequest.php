<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'date' => ['required', 'date', 'after:today'],
            'guests' => ['required', 'integer', 'min:2', 'max:8'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
