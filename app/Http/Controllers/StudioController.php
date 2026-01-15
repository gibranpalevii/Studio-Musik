<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;
use Illuminate\Support\Facades\Storage; // Ganti File dengan Storage

class StudioController extends Controller
{
    // 1. Tampilkan Daftar Studio
    public function index()
    {
        $studios = Studio::all(); 
        return view('daftar_studio', compact('studios'));
    }

    // 2. Tampilkan Form Tambah
    public function create()
    {
        return view('tambah_studio');
    }

    // 3. Proses Simpan Data (PERBAIKAN DISINI)
    public function store(Request $request)
    {
        $request->validate([
            'nama_studio' => 'required',
            'harga_per_jam' => 'required|numeric',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $studio = new Studio();
        $studio->nama_studio = $request->nama_studio;
        $studio->harga_per_jam = $request->harga_per_jam;
        $studio->status = $request->status;

        // LOGIKA PENYIMPANAN YANG BENAR (Masuk ke folder storage)
        if ($request->hasFile('foto')) {
            // Ini akan menyimpan ke: storage/app/public/studio-images
            $path = $request->file('foto')->store('studio-images', 'public');
            $studio->foto = $path;
        }

        $studio->save();

        return redirect('/studio')->with('success', 'Studio berhasil ditambahkan!');
    }

    // 4. Tampilkan Form Edit
    public function edit($id)
    {
        $studio = Studio::find($id);
        if (!$studio) return redirect('/studio');
        return view('edit_studio', compact('studio'));
    }

    // 5. Proses Update (PERBAIKAN DISINI)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_studio' => 'required',
            'harga_per_jam' => 'required|numeric',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $studio = Studio::find($id);
        
        $studio->nama_studio = $request->nama_studio;
        $studio->harga_per_jam = $request->harga_per_jam;
        $studio->status = $request->status;

        // LOGIKA UPDATE FOTO
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($studio->foto) {
                Storage::disk('public')->delete($studio->foto);
            }
            
            // Upload foto baru ke folder storage
            $path = $request->file('foto')->store('studio-images', 'public');
            $studio->foto = $path;
        }

        $studio->save(); 

        return redirect('/studio')->with('success', 'Data Studio diperbarui!');
    }

    // 6. Proses Hapus
    public function destroy($id)
    {
        $studio = Studio::find($id);

        if ($studio) {
            // Hapus foto dari storage
            if ($studio->foto) {
                Storage::disk('public')->delete($studio->foto);
            }

            $studio->delete();
            return redirect('/studio')->with('success', 'Studio dihapus!');
        }

        return redirect('/studio')->with('error', 'Data tidak ditemukan');
    }
}