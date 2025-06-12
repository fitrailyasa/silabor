<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:peminjaman-transaksi')->only(['transaksiPeminjaman', 'validasiPeminjaman']);
        $this->middleware('permission:penggunaan-transaksi')->only(['transaksiPenggunaan', 'validasiPenggunaan']);
        $this->middleware('permission:pengembalian-transaksi')->only(['transaksiPengembalian', 'validasiPengembalian']);
    }

    public function transaksiPeminjaman(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|in:10,50,100',
        ]);

        $search = $request->input('search');
        $perPage = (int) $request->input('perPage', 10);

        $validPerPage = in_array($perPage, [10, 50, 100]) ? $perPage : 10;

        if ($search) {
            $laporans = Laporan::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $laporans = Laporan::paginate($validPerPage);
        }

        return view("admin.transaksi.peminjaman.index", compact('laporans', 'search', 'perPage'));
    }

    public function validasiPeminjaman()
    {
        // 
    }

    public function transaksiPenggunaan(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|in:10,50,100',
        ]);

        $search = $request->input('search');
        $perPage = (int) $request->input('perPage', 10);

        $validPerPage = in_array($perPage, [10, 50, 100]) ? $perPage : 10;

        if ($search) {
            $laporans = Laporan::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $laporans = Laporan::paginate($validPerPage);
        }

        return view("admin.transaksi.penggunaan.index", compact('laporans', 'search', 'perPage'));
    }

    public function validasiPenggunaan()
    {
        // 
    }

    public function transaksiPengembalian(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|in:10,50,100',
        ]);

        $search = $request->input('search');
        $perPage = (int) $request->input('perPage', 10);

        $validPerPage = in_array($perPage, [10, 50, 100]) ? $perPage : 10;

        if ($search) {
            $laporans = Laporan::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $laporans = Laporan::paginate($validPerPage);
        }

        return view("admin.transaksi.pengembalian.index", compact('laporans', 'search', 'perPage'));
    }

    public function validasiPengembalian()
    {
        // 
    }
}
