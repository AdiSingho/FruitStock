<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBuahRequest extends FormRequest 
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Memastikan ID kategori yang diinput benar-benar ada di database
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'nama_buah' => ['required', 'string', 'max:255'],
            
            // Menggunakan numeric karena tipe datanya decimal
            'harga_beli' => ['required', 'numeric', 'min:0'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
            
            'estimasi_masa_simpan' => ['required', 'integer', 'min:1'],
            'satuan' => ['required', 'string', 'max:50'],
        ];
    }
}