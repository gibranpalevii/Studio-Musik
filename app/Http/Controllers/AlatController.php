<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatMusik;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function index()
    {
        $alat = AlatMusik::all();
        // PERBAIKAN: Menghapus 'alat.' karena file ada di resources/views/ langsung
        return view('daftar_alat', compact('alat'));
    }

    public function create()
    {
        // PERBAIKAN: Menghapus 'alat.'
        return view('tambah_alat');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'kondisi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $alat = new AlatMusik();
        $alat->nama_alat = $request->nama_alat;
        $alat->harga_sewa = $request->harga_sewa;
        $alat->stok = $request->stok;
        $alat->kondisi = $request->kondisi;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('alat-images', 'public'); 
            $alat->foto = $path;
        }

        $alat->save();
        return redirect('/alat')->with('success', 'Berhasil menambahkan alat baru!');
    }

    public function edit($id)
    {
        $alat = AlatMusik::find($id);
        if (!$alat) return redirect('/alat');
        // PERBAIKAN: Menghapus 'alat.'
        return view('edit_alat', compact('alat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat' => 'required',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'kondisi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $alat = new AlatMusik();
        $alat = AlatMusik::find($id);
        
        $alat->nama_alat = $request->nama_alat;
        $alat->harga_sewa = $request->harga_sewa;
        $alat->stok = $request->stok;
        $alat->kondisi = $request->kondisi;

        if ($request->hasFile('foto')) {
            if ($alat->foto) {
                Storage::disk('public')->delete($alat->foto);
            }
            $path = $request->file('foto')->store('alat-images', 'public');
            $alat->foto = $path;
        }

        $alat->save();
        return redirect('/alat')->with('success', 'Data alat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $alat = AlatMusik::find($id);
        if ($alat) {
            if ($alat->foto) {
                Storage::disk('public')->delete($alat->foto);
            }
            $alat->delete();
            return redirect('/alat')->with('success', 'Alat musik berhasil dihapus!');
        }
        return redirect('/alat')->with('error', 'Data tidak ditemukan');
    }
}