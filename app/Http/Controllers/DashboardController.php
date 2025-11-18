<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Lembaga;

class DashboardController extends Controller
{
    public function index()
    {
        // Total siswa keseluruhan
        $totalSiswa = Siswa::count();

        // Ambil semua lembaga
        $lembaga = Lembaga::all();

        // Hitung total siswa per lembaga
        $totalPerLembaga = $lembaga->map(function($l){
            return (object)[
                'nama_lembaga' => $l->nama_lembaga,
                'siswa_count' => $l->siswa()->count()
            ];
        });

        return view('dashboard.index', compact('totalSiswa', 'totalPerLembaga'));
    }
}
