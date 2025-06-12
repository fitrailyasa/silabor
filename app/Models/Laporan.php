<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'alat_id', 'ruangan_id', 'jenis_peminjaman', 'tujuan_peminjaman', 'catatan', 'tgl_peminjaman', 'tgl_pengembalian', 'jam_peminjaman', 'jam_pengembalian', 'status_peminjaman', 'status_pengembalian'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
