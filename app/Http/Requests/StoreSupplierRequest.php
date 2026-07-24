<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_supplier' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:20'],
        ];
    }
}