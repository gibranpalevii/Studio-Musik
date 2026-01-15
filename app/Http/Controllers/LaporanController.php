<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dari input (jika ada)
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        // Mulai Query Transaksi
        $query = Transaksi::with('pelanggan');

        // Jika user melakukan filter tanggal
        if ($tgl_awal && $tgl_akhir) {
            $query->whereBetween('tanggal', [$tgl_awal, $tgl_akhir]);
        }

        // Ambil data dan urutkan dari yang terbaru
        $transaksi = $query->latest()->get();
        
        // --- PERBAIKAN DI SINI ---
        // Jangan pakai $query->sum(), tapi filter dari data yang sudah diambil ($transaksi)
        // Kita buang status 'Batal', lalu jumlahkan sisanya.
        $totalPendapatan = $transaksi->where('status', '!=', 'Batal')->sum('total_biaya');
        // -------------------------

        return view('laporan.index', compact('transaksi', 'totalPendapatan', 'tgl_awal', 'tgl_akhir'));
    }

    public function cetak(Request $request)
    {
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $query = Transaksi::with('pelanggan');

        if ($tgl_awal && $tgl_akhir) {
            $query->whereBetween('tanggal', [$tgl_awal, $tgl_akhir]);
        }

        $transaksi = $query->latest()->get();
        
        // Bagian ini sudah benar sebelumnya, kita pertahankan
        $totalPendapatan = $transaksi->where('status', '!=', 'Batal')->sum('total_biaya');

        return view('laporan.cetak', compact('transaksi', 'totalPendapatan', 'tgl_awal', 'tgl_akhir'));
    }
}