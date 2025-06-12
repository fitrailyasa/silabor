<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientRiwayatController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:history-client')->only(['index']);
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

        $userId = Auth::id();

        $query = Laporan::where('user_id', $userId);

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $laporans = $query->orderBy('created_at', 'desc')->paginate($validPerPage);

        return view("client.riwayat.index", compact('laporans', 'search', 'perPage'));
    }
}
