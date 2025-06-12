<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Laporan;
use App\Models\User;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientPengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pengajuan-peminjaman-client')->only(['index']);
    }

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'perPage' => 'nullable|integer|in:10,50,100',
        ]);

        $search = $request->input('search');
        $perPage = (int) $request->input('perPage', 10);

        $validPerPage = in_array($perPage, [10, 50, 100]) ? $perPage : 10;

        $anggotas = User::role('mahasiswa')->get();
        $dosens = User::role('dosen')->get();

        if ($search) {
            $alats = Alat::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
            $ruangans = Ruangan::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $alats = Alat::paginate($validPerPage);
            $ruangans = Ruangan::paginate($validPerPage);
        }

        return view("client.pengajuan-peminjaman.index", compact('alats', 'ruangans', 'anggotas', 'dosens', 'search', 'perPage'));
    }

    public function store(Request $request)
    {
        $start = Carbon::parse($request->input('start_datetime'));
        $end = Carbon::parse($request->input('end_datetime'));

        $data = [
            'tgl_peminjaman'   => $start->format('Y-m-d'),
            'jam_peminjaman'   => $start->format('H:i'),
            'tgl_pengembalian' => $end->format('Y-m-d'),
            'jam_pengembalian' => $end->format('H:i'),
        ];

        dd($data);
        Laporan::create($data);
    }
}
