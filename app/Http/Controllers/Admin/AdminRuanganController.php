<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Requests\RuanganRequest;

class AdminRuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-ruangan')->only(['index']);
        $this->middleware('permission:create-ruangan')->only(['store']);
        $this->middleware('permission:edit-ruangan')->only(['update']);
        $this->middleware('permission:delete-ruangan')->only(['destroy']);
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
            $ruangans = Ruangan::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $ruangans = Ruangan::paginate($validPerPage);
        }

        return view("admin.ruangan.index", compact('ruangans', 'search', 'perPage'));
    }

    public function store(RuanganRequest $request)
    {
        Ruangan::create($request->validated());
        return back()->with('message', 'Berhasil Tambah Data Ruangan!');
    }

    public function update(RuanganRequest $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($request->validated());
        return back()->with('message', 'Berhasil Edit Data Ruangan!');
    }

    public function destroy($id)
    {
        Ruangan::findOrFail($id)->forceDelete();
        return back()->with('message', 'Berhasil Hapus Data Ruangan!');
    }
}
