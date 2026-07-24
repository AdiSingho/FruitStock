<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Keranjang belanja harus berupa array dan tidak boleh kosong
            'keranjang' => ['required', 'array'],
            // Mengecek setiap isi keranjang
            'keranjang.*.buah_id' => ['required', 'exists:buahs,id'],
            'keranjang.*.qty' => ['required', 'numeric', 'min:0.1'],
        ];
    }
}