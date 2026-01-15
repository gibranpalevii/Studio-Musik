<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Studio;
use App\Models\AlatMusik;
use Carbon\Carbon; 

class TransaksiController extends Controller
{
    // 1. Tampilkan Daftar Riwayat Transaksi
    public function index()
    {
        // 'with' digunakan agar pengambilan data relasi lebih optimal
        $data = Transaksi::with('pelanggan')->latest()->get();
        return view('daftar_transaksi', compact('data'));
    }

    // 2. Tampilkan Form Sewa Baru
    public function create()
    {
        $pelanggans = Pelanggan::all();
        $studios = Studio::all();
        $alats = AlatMusik::all();

        return view('tambah_transaksi', compact('pelanggans', 'studios', 'alats'));
    }

    // 3. Simpan Transaksi ke Database
    public function store(Request $request)
    {
        // A. Validasi
        $request->validate([
            'id_pelanggan' => 'required',
            'jenis_transaksi' => 'required',
            'nama_item' => 'required',
            'tanggal' => 'required',
            'durasi' => 'required',
            'total_biaya' => 'required',
        ]);

        // B. GENERATE KODE OTOMATIS (Format: TRX-20231025-001)
        $tanggal_format = date('Ymd'); 
        
        // Hitung transaksi hari ini untuk nomor urut
        $jumlah_hari_ini = Transaksi::whereDate('created_at', Carbon::today())->count();
        $nomor_urut = $jumlah_hari_ini + 1;
        
        $kode_final = "TRX-" . $tanggal_format . "-" . sprintf("%03d", $nomor_urut);

        // C. Simpan Data
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = $kode_final;
        $transaksi->id_pelanggan = $request->id_pelanggan;
        $transaksi->jenis_transaksi = $request->jenis_transaksi;
        $transaksi->nama_item = $request->nama_item;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->durasi = $request->durasi;
        $transaksi->total_biaya = $request->total_biaya;
        
        // Set Default Value
        $transaksi->status_bayar = 'Belum Lunas'; 
        $transaksi->status = 'Proses'; 
        
        $transaksi->save();

        return redirect('/transaksi')->with('success', 'Transaksi berhasil! Kode: ' . $kode_final);
    }
    
    // 4. Ubah Status Sewa (Selesai/Batal)
    public function updateStatus($id, $status)
    {
        $transaksi = Transaksi::find($id);
        if($transaksi) {
            $transaksi->status = $status;
            $transaksi->save();
        }
        return back()->with('success', 'Status transaksi diperbarui!');
    }

    // 5. Update Status Pembayaran (Lunas)
    public function updateBayar($id)
    {
        $transaksi = Transaksi::find($id);
        if($transaksi) {
            $transaksi->status_bayar = 'Lunas';
            $transaksi->save();
        }
        return back()->with('success', 'Pembayaran berhasil dikonfirmasi LUNAS!');
    }

    // 6. Hapus Transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        if($transaksi) {
            $transaksi->delete();
        }
        return back()->with('success', 'Data transaksi dihapus');
    }
}