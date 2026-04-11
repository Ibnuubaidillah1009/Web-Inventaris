<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetMutationRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'fixed_asset_id'   => 'required|exists:fixed_assets,id',
            'from_location_id' => 'nullable|exists:locations,id',
            'to_location_id'   => 'required|exists:locations,id|different:from_location_id',
            'mutation_date'    => 'required|date',
            'notes'            => 'nullable|string',
        ];
    }
}
