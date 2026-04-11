<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'location_code' => 'required|string|max:50|unique:locations,location_code',
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
        ];
    }
}
