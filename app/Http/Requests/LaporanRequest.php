<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanRequest extends FormRequest
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
            'user_id' => 'required',
            'alat_id' => 'required',
            'bahan_id' => 'required',
            'ruangan_id' => 'required',
            'tgl_peminjaman' => 'required',
            'tgl_pengembalian' => 'required',
            'status_peminjaman' => 'required',
            'status_pengembalian' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong!',
            'name.max' => 'Nama maksimal 100 karakter!',
            'user_id.required' => 'User tidak boleh kosong!',
            'alat_id.required' => 'Alat tidak boleh kosong!',
            'bahan_id.required' => 'Bahan tidak boleh kosong!',
            'ruangan_id.required' => 'Ruangan tidak boleh kosong!',
            'tgl_peminjaman.required' => 'Tanggal peminjaman tidak boleh kosong!',
            'tgl_pengembalian.required' => 'Tanggal pengembalian tidak boleh kosong!',
            'status_peminjaman.required' => 'Status peminjaman tidak boleh kosong!',
            'status_pengembalian.required' => 'Status pengembalian tidak boleh kosong!',
        ];
    }
}
