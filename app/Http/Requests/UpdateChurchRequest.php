<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChurchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $churchId = $this->route('church')->id ?? null;

        return [
            'name' => 'required|string|min:3|max:255|unique:churches,name,' . $churchId,
            'location' => 'required|string|min:3|max:255',
            'denomination' => 'nullable|string|max:255',
        ];
    }
}
