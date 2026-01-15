<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Studio; 
use App\Models\AlatMusik;
use App\Models\Transaksi; 
use App\Models\Pelanggan; 

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Cek Login
        if (!Session::has('is_login')) {
            return redirect('/login')->with('error', 'Silakan login dahulu!');
        }

        // --- MULAI HITUNG DATA REAL ---

        // A. Hitung Total Pendapatan
        $totalPendapatan = Transaksi::sum('total_biaya');

        // B. Hitung Jumlah Data Master
        $totalStudio = Studio::count();
        $totalAlat = AlatMusik::count();
        $totalPelanggan = Pelanggan::count();

        // C. Ambil Transaksi Terakhir (DENGAN PAGINATION)
        // Kita pakai 'with' agar nama pelanggan terpanggil otomatis (lebih cepat)
        // Kita ganti 'limit(5)->get()' menjadi 'paginate(5)'
        $transaksiTerbaru = Transaksi::with('pelanggan')
                            ->latest()
                            ->paginate(5); 

        // Kirim semua variabel ke View 'dashboard'
        return view('dashboard', compact(
            'totalPendapatan', 
            'totalStudio', 
            'totalAlat', 
            'totalPelanggan',
            'transaksiTerbaru'
        ));
    }
}