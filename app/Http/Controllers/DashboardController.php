<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPrediksi;

class DashboardController extends Controller
{
    // Method untuk halaman dashboard utama
    public function index()
    {
        // Ambil 10 hasil prediksi terbaru beserta relasi prediksinya
        $hasilPrediksi = HasilPrediksi::with('prediksi')->latest()->take(10)->get();
        return view('dashboard', compact('hasilPrediksi'));
    }

    // Method untuk halaman prediksi
    public function prediksi()
    {
        return view('pages.prediksi');
    }

    // Method untuk halaman histori
    public function histori()
    {
        return view('pages.histori');
    }

    // Method untuk halaman tentang aplikasi
    public function about()
    {
        return view('pages.about');
    }
}
