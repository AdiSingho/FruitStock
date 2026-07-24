<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQcReturRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stok_id' => ['required', 'exists:stoks,id'],
            'qty_rusak' => ['required', 'numeric', 'min:0.1'],
            'alasan' => ['required', 'string'],
            'tindakan' => ['required', 'in:buang,retur'],
            'tanggal_qc' => ['required', 'date'],
        ];
    }
}