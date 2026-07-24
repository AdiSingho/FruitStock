<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        // Mengambil ID kategori dari parameter URL (route)
        $id = $this->route('kategori'); 
        
        return [
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:kategoris,nama_kategori,' . $id],
        ];
    }
}