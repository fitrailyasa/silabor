<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Laporan;
use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'jenis' => 'required|in:pribadi,kelompok',
            'tujuan_peminjaman' => 'required|string',
            'judul_penelitian' => 'required|string',
            'dosen_pembimbing' => 'required|exists:users,id',
            'tgl_peminjaman' => 'required|date',
            'tgl_pengembalian' => 'required|date|after_or_equal:tgl_peminjaman',
            'daftar_anggota' => 'nullable|string',
            'daftar_alat' => 'required|string',
        ]);

        $laporan = Laporan::create([
            'user_id' => auth()->id(),
            'dosen_id' => $request->dosen_pembimbing,
            'jenis_peminjaman' => $request->jenis,
            'judul_penelitian' => $request->judul_penelitian,
            'tujuan_peminjaman' => $request->tujuan_peminjaman,
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'status_peminjaman' => 'menunggu',
        ]);

        $alatList = json_decode($request->daftar_alat, true);
        foreach ($alatList as $alatData) {
            $alat = Alat::where('name', $alatData['nama'])->first();
            if ($alat) {
                $laporan->alats()->attach($alat->id, ['qty' => $alatData['qty']]);
            }
        }

        if ($request->jenis === 'kelompok') {
            $anggotaList = json_decode($request->daftar_anggota, true);
            foreach ($anggotaList as $anggotaName) {
                $user = User::where('name', $anggotaName)->first();
                if ($user) {
                    $laporan->anggotas()->attach($user->id);
                }
            }
        }

        return redirect()->route('mahasiswa.pengajuan-peminjaman.index')->with('message', 'Peminjaman berhasil diajukan.');
    }

    public function generateFormulir()
    {
        $user = Auth::user();

        $bulanIndo = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $tanggalHariIni = 'Lampung Selatan, ' . date('j') . ' ' . $bulanIndo[date('n')] . ' ' . date('Y');

        $pdf = Pdf::loadView('admin.transaksi.peminjaman.pdf.index', compact('user', 'tanggalHariIni'))->setPaper('A4', 'portrait');
        return $pdf->stream('Formulir-Peminjaman-Alat.pdf');
    }
}
