<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BahanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:100',
            ],
            'desc' => 'nullable|max:1000',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location' => 'required|max:100',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong!',
            'name.max' => 'Nama maksimal 100 karakter!',
            'desc.max' => 'Deskripsi maksimal 1000 karakter!',
            'img.image' => 'File harus berupa gambar!',
            'img.mimes' => 'Format gambar tidak valid!',
            'img.max' => 'Ukuran gambar maksimal 2MB!',
            'location.required' => 'Lokasi tidak boleh kosong!',
            'location.max' => 'Lokasi maksimal 100 karakter!',
            'category_id.required' => 'Kategori tidak boleh kosong!',
            'category_id.exists' => 'Kategori tidak valid!',
        ];
    }
}
