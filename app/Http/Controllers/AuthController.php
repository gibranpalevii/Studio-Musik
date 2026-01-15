<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Gunakan Model User (bukan DB::table admin)
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function index()
    {
        return view('login');
    }

    // 2. Proses Login
    public function login(Request $request)
    {
        // Validasi input wajib diisi
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Ambil data dari input form
        $email = $request->input('email');
        $password = $request->input('password');

        // Cari user di tabel 'users' berdasarkan email
        $user = User::where('email', $email)->first();

        // Cek: Apakah user ketemu DAN Password-nya cocok (Hash::check)
        if ($user && Hash::check($password, $user->password)) {
            
            // Simpan data ke sesi (Session)
            Session::put('id_user', $user->id);
            Session::put('nama_admin', $user->name); // Di tabel users kolomnya 'name'
            Session::put('is_login', true);

            // Redirect ke Dashboard
            return redirect('/dashboard')->with('success', 'Selamat Datang, ' . $user->name . '!');
        } else {
            // Jika gagal
            return redirect('/login')->with('error', 'Email atau Password salah!');
        }
    }

    // 3. Proses Logout
    public function logout()
    {
        Session::flush(); // Hapus semua sesi
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}