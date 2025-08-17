<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChurchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Later you can restrict with auth/roles
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:churches,name',
            'location' => 'required|string|min:3|max:255',
            'denomination' => 'nullable|string|max:255',
        ];
    }
}
