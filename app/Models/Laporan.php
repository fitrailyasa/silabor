<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'dosen_id', 'alat_id', 'ruangan_id', 'jenis_peminjaman', 'tujuan_peminjaman', 'catatan', 'tgl_peminjaman', 'tgl_pengembalian', 'waktu_mulai', 'waktu_selesai', 'status_peminjaman', 'status_pengembalian'];

    public function alats()
    {
        return $this->belongsToMany(Alat::class, 'laporan_alat')->withPivot('qty');
    }

    public function anggotas()
    {
        return $this->belongsToMany(User::class, 'laporan_anggota', 'laporan_id', 'user_id');
    }


    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
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
