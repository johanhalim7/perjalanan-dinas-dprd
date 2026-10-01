<?php

namespace App\Http\Controllers;

use App\Models\PerjalananDinas;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // QUERY DASAR
        $query = PerjalananDinas::query();

        // JIKA PEGAWAI → FILTER LEWAT PIVOT
        if ($user->role === 'pegawai') {
            $query->whereHas('pegawai', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            });
        }

        $totalPerjalanan = $query->count();
        $totalAnggaran   = $query->sum('anggaran');
        $tahunAktif      = date('Y');

        return view('dashboard', compact(
            'totalPerjalanan',
            'totalAnggaran',
            'tahunAktif'
        ));
    }
}
