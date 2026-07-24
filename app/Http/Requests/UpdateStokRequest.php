<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStokRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'buah_id' => ['required', 'exists:buahs,id'],
            'gudang_id' => ['required', 'exists:gudangs,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'jumlah' => ['required', 'numeric', 'min:0'],
            'tanggal_masuk' => ['required', 'date'],
            'status' => ['required', 'string'],
        ];
    }
}