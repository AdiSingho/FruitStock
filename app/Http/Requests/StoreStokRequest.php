<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStokRequest extends FormRequest
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
            'jumlah' => ['required', 'numeric', 'min:0.1'],
            'tanggal_masuk' => ['required', 'date'],
        ];
    }
}