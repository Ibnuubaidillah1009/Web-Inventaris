<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockOpnameRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'opnable_type'     => 'required|string|in:App\Models\FixedAsset,App\Models\Building',
            'opnable_id'       => 'required|integer|min:1',
            'opname_date'      => 'required|date',
            'actual_condition' => 'required|in:baik,rusak_ringan,rusak_berat',
            'notes'            => 'nullable|string',
        ];
    }
}
