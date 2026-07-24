<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGudangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Mengambil data gudang yang sedang diedit dari URL
        $gudang = $this->route('gudang');
        $id = $gudang ? $gudang->id : null;

        return [
            // Tambahkan pengecualian ID agar kode rak tidak dianggap duplikat dengan miliknya sendiri
            'kode_rak' => ['required', 'string', 'unique:gudangs,kode_rak,' . $id],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'keterangan' => ['nullable', 'string'],
        ];
    }
}