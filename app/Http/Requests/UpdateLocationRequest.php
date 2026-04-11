<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $locationId = $this->route('location');

        return [
            'location_code' => "sometimes|required|string|max:50|unique:locations,location_code,{$locationId}",
            'name'          => 'sometimes|required|string|max:255',
            'description'   => 'nullable|string',
        ];
    }
}
