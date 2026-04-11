<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetDisposalRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'disposable_type' => 'required|string|in:App\Models\FixedAsset,App\Models\Building',
            'disposable_id'   => 'required|integer|min:1',
            'disposal_date'   => 'required|date',
            'reason'          => 'required|in:rusak,dijual,hilang,diganti',
            'notes'           => 'nullable|string',
        ];
    }
}
