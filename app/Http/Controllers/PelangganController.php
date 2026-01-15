<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        // Kita kirim variabel bernama 'pelanggan'
        return view('daftar_pelanggan', compact('pelanggan'));
    }

    public function create()
    {
        return view('tambah_pelanggan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $pelanggan = new Pelanggan();
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->no_hp = $request->no_hp;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();

        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil disimpan');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        return view('edit_pelanggan', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->no_hp = $request->no_hp;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();

        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        if ($pelanggan) {
            $pelanggan->delete();
        }
        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil dihapus');
    }
}