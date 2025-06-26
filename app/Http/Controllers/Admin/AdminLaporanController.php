<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\LaporanPeminjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPeminjamanExport;
use App\Exports\LaporanPenggunaanExport;
use App\Exports\LaporanKerusakanExport;

class AdminLaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:peminjaman-laporan')->only(['laporanPeminjaman']);
        $this->middleware('permission:penggunaan-laporan')->only(['laporanPenggunaan']);
        $this->middleware('permission:kerusakan-laporan')->only(['laporanKerusakan']);
    }

    public function exportLaporanPeminjaman()
    {
        return Excel::download(new LaporanPeminjamanExport, 'Laporan Peminjaman.xlsx');
    }

    public function exportLaporanPenggunaan()
    {
        return Excel::download(new LaporanPenggunaanExport, 'Laporan Penggunaan.xlsx');
    }

    public function exportLaporanKerusakan()
    {
        return Excel::download(new LaporanKerusakanExport, 'Laporan Kerusakan.xlsx');
    }

    public function laporanPeminjaman(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|in:10,50,100',
        ]);

        $search = $request->input('search');
        $perPage = (int) $request->input('perPage', 10);

        $validPerPage = in_array($perPage, [10, 50, 100]) ? $perPage : 10;

        if ($search) {
            $laporans = LaporanPeminjaman::whereIn('status_validasi', ['Diterima', 'Ditolak'])->orderBy('updated_at', 'desc')->where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $laporans = LaporanPeminjaman::whereIn('status_validasi', ['Diterima', 'Ditolak'])->orderBy('updated_at', 'desc')->paginate($validPerPage);
        }

        return view("admin.laporan.peminjaman.index", compact('laporans', 'search', 'perPage'));
    }

    public function laporanPenggunaan(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|in:10,50,100',
        ]);

        $search = $request->input('search');
        $perPage = (int) $request->input('perPage', 10);

        $validPerPage = in_array($perPage, [10, 50, 100]) ? $perPage : 10;

        if ($search) {
            $laporans = Laporan::whereIn('status_peminjaman', ['Diterima', 'Ditolak'])->orderBy('updated_at', 'desc')->where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $laporans = Laporan::whereIn('status_peminjaman', ['Diterima', 'Ditolak'])->orderBy('updated_at', 'desc')->paginate($validPerPage);
        }

        return view("admin.laporan.penggunaan.index", compact('laporans', 'search', 'perPage'));
    }

    public function laporanKerusakan(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|in:10,50,100',
        ]);

        $search = $request->input('search');
        $perPage = (int) $request->input('perPage', 10);

        $validPerPage = in_array($perPage, [10, 50, 100]) ? $perPage : 10;

        if ($search) {
            $laporans = Laporan::whereIn('status_peminjaman', ['Diterima', 'Ditolak'])->orderBy('updated_at', 'desc')->where('kondisi_setelah', 'Rusak')->where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $laporans = Laporan::whereIn('status_peminjaman', ['Diterima', 'Ditolak'])->orderBy('updated_at', 'desc')->where('kondisi_setelah', 'Rusak')->paginate($validPerPage);
        }

        return view("admin.laporan.kerusakan.index", compact('laporans', 'search', 'perPage'));
    }
}
