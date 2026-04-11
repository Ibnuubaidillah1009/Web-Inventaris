<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFixedAssetRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'             => 'sometimes|required|string|max:255',
            'location_id'      => 'nullable|exists:locations,id',
            'brand'            => 'nullable|string|max:150',
            'purchase_year'    => 'nullable|digits:4|integer',
            'condition_status' => 'nullable|in:baik,rusak_ringan,rusak_berat',
            'is_active'        => 'nullable|boolean',
        ];
    }
}
