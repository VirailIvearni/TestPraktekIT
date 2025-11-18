<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Lembaga;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();

        $lembaga = Lembaga::all();

        $totalPerLembaga = $lembaga->map(function($l){
            return (object)[
                'nama_lembaga' => $l->nama_lembaga,
                'siswa_count' => $l->siswa()->count()
            ];
        });

        return view('dashboard.index', compact('totalSiswa', 'totalPerLembaga'));
    }
}
