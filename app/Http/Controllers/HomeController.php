<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;
use App\Models\AlatMusik;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data studio dan alat musik
        $studios = Studio::all();
        $alats = AlatMusik::all();

        // Kirim data ke tampilan (view) 'home'
        return view('home', compact('studios', 'alats'));
    }
}