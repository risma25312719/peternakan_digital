<?php

namespace App\Http\Controllers;

use App\DataTernak;
use App\Kandang;
use App\DataPakan;
use App\Kesehatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalTernak = DataTernak::count();
        $totalKandang = Kandang::count();
        $totalPakan = DataPakan::sum('stok');
        $catatanKesehatan = Kesehatan::count();

        // Data untuk grafik populasi ternak per jenis (contoh)
        $populasiPerJenis = DataTernak::selectRaw('jenis_hewan, count(*) as total')
                            ->groupBy('jenis_hewan')
                            ->pluck('total', 'jenis_hewan')
                            ->toArray();

        // Aktivitas kesehatan terbaru (5 record)
        $aktivitasTerbaru = Kesehatan::with('dataTernak')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('dashboard', compact(
            'totalTernak', 'totalKandang', 'totalPakan', 'catatanKesehatan',
            'populasiPerJenis', 'aktivitasTerbaru'
        ));
    }
}