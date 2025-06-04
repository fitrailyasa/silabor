<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Http\Requests\LaporanRequest;

class AdminLaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-laporan')->only(['index']);
        $this->middleware('permission:create-laporan')->only(['store']);
        $this->middleware('permission:edit-laporan')->only(['update']);
        $this->middleware('permission:delete-laporan')->only(['destroy']);
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

        if ($search) {
            $laporans = Laporan::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $laporans = Laporan::paginate($validPerPage);
        }

        return view("admin.laporan.index", compact('laporans', 'search', 'perPage'));
    }

    public function store(LaporanRequest $request)
    {
        Laporan::create($request->validated());
        return back()->with('message', 'Berhasil Tambah Data Laporan!');
    }

    public function update(LaporanRequest $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update($request->validated());
        return back()->with('message', 'Berhasil Edit Data Laporan!');
    }

    public function destroy($id)
    {
        Laporan::findOrFail($id)->forceDelete();
        return back()->with('message', 'Berhasil Hapus Data Laporan!');
    }
}
