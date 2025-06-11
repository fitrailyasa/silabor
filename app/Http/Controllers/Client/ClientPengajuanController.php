<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Bahan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class ClientPengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:check-client')->only(['index']);
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
            $bahans = Bahan::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
            $ruangans = Ruangan::where('name', 'like', "%{$search}%")
                ->paginate($validPerPage);
        } else {
            $alats = Alat::paginate($validPerPage);
            $bahans = Bahan::paginate($validPerPage);
            $ruangans = Ruangan::paginate($validPerPage);
        }

        return view("client.cek.index", compact('alats', 'bahans', 'ruangans', 'search', 'perPage'));
    }
}
