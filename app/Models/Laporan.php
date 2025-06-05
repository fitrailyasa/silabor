<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'user_id', 'alat_id', 'bahan_id', 'ruangan_id', 'tgl_peminjaman', 'tgl_pengembalian', 'status_peminjaman', 'status_pengembalian'];
}
