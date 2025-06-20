<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Ruangan;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClientPenggunaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:penggunaan-alat-client')->only(['indexAlat']);
        $this->middleware('permission:penggunaan-ruangan-client')->only(['indexRuangan']);
    }

    public function indexAlat(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|in:10,50,100',
        ]);

        $search = $request->input('search');
        $perPage = (int) $request->input('perPage', 10);

        $validPerPage = in_array($perPage, [10, 50, 100]) ? $perPage : 10;

        if ($search) {
            $alats = Alat::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $alats = Alat::paginate($validPerPage);
        }

        return view("client.penggunaan-alat.index", compact('alats','search', 'perPage'));
    }

    public function indexRuangan(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|in:10,50,100',
        ]);

        $search = $request->input('search');
        $perPage = (int) $request->input('perPage', 10);

        $validPerPage = in_array($perPage, [10, 50, 100]) ? $perPage : 10;

        if ($search) {
            $ruangans = Ruangan::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $ruangans = Ruangan::paginate($validPerPage);
        }

        return view("client.penggunaan-ruangan.index", compact('ruangans', 'search', 'perPage'));
    }

    public function storeRuangan(Request $request)
    {        
        $start = Carbon::parse($request->input('start_datetime'));
        $end = Carbon::parse($request->input('end_datetime'));

        $data = [
            'ruangan_id' => $request->input('ruangan_id'),
            'tgl_peminjaman'   => $start->format('Y-m-d'),
            'waktu_mulai'   => $start->format('H:i'),
            'tgl_pengembalian' => $end->format('Y-m-d'),
            'waktu_selesai' => $end->format('H:i'),
            'tujuan_peminjaman' => $request->input('tujuan_peminjaman'),
        ];

        dd($data);

        Laporan::create($data);

        return redirect()->back()->with('message', 'Data berhasil disimpan');
    }
}
