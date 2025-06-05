<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use App\Http\Requests\AlatRequest;

class AdminAlatController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-alat')->only(['index']);
        $this->middleware('permission:create-alat')->only(['store']);
        $this->middleware('permission:edit-alat')->only(['update']);
        $this->middleware('permission:delete-alat')->only(['destroy']);
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
            $alats = Alat::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $alats = Alat::paginate($validPerPage);
        }

        return view("admin.alat.index", compact('alats', 'search', 'perPage'));
    }

    public function store(AlatRequest $request)
    {
        $alat = Alat::create($request->validated());

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $file_name = $alat->name . '_' . $img->getClientOriginalExtension();
            $alat->img = $file_name;
            $alat->update();
            $img->storeAs('public', $file_name);
        }

        return back()->with('message', 'Berhasil Tambah Data Alat!');
    }

    public function update(AlatRequest $request, $id)
    {
        $alat = Alat::findOrFail($id);
        $alat->update($request->validated());

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $file_name = $alat->name . '_' . $img->getClientOriginalExtension();
            $alat->img = $file_name;
            $alat->update();
            $img->storeAs('public', $file_name);
        }
        
        return back()->with('message', 'Berhasil Edit Data Alat!');
    }

    public function destroy($id)
    {
        Alat::findOrFail($id)->forceDelete();
        return back()->with('message', 'Berhasil Hapus Data Alat!');
    }
}
