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
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alats,id',
            'bahan_id' => 'required|exists:bahans,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'jenis_peminjaman' => 'required|max:100',
            'tujuan_peminjaman' => 'required|max:100',
            'ringkasan_peminjaman' => 'required|max:100',
            'tgl_peminjaman' => 'required|max:100',
            'tgl_pengembalian' => 'required|max:100',
            'jam_peminjaman' => 'required|max:100',
            'jam_pengembalian' => 'required|max:100',
            'status_peminjaman' => 'required|max:100',
            'status_pengembalian' => 'required|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attribute wajib diisi.',
            '*.max' => 'Maksimal 100 karakter.',
            'user_id.exists' => 'User tidak valid.',
            'alat_id.exists' => 'Alat tidak valid.',
            'bahan_id.exists' => 'Bahan tidak valid.',
            'ruangan_id.exists' => 'Ruangan tidak valid.',
        ];
    }
}
