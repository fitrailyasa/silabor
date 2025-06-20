<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\LaporanPeminjaman;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-laporan')->only(['index']);
    }

    public function indexPeminjaman(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|in:10,50,100',
        ]);

        $search = $request->input('search');
        $perPage = (int) $request->input('perPage', 10);

        $validPerPage = in_array($perPage, [10, 50, 100]) ? $perPage : 10;

        if ($search) {
            $laporans = LaporanPeminjaman::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $laporans = LaporanPeminjaman::paginate($validPerPage);
        }

        return view("admin.laporan.peminjaman.index", compact('laporans', 'search', 'perPage'));
    }

    public function indexPenggunaan(Request $request)
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

        return view("admin.laporan.penggunaan.index", compact('laporans', 'search', 'perPage'));
    }

    public function indexKerusakan(Request $request)
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

        return view("admin.laporan.kerusakan.index", compact('laporans', 'search', 'perPage'));
    }
}
