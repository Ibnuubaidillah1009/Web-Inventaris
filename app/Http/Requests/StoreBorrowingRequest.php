<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowingRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'borrower_name'        => 'required|string|max:255',
            'borrow_date'          => 'required|date',
            'expected_return_date' => 'required|date|after_or_equal:borrow_date',
            'details'              => 'required|array|min:1',
            'details.*.fixed_asset_id'         => 'required|exists:fixed_assets,id',
            'details.*.condition_when_borrowed' => 'nullable|in:baik,rusak_ringan,rusak_berat',
        ];
    }
}
