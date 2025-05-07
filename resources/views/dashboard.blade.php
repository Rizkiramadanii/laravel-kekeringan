@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4 text-dark fw-bold"><i class="fas fa-home"></i> BERANDA</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Selamat Datang di Halaman Beranda!</li>
    </ol>

    <div class="row">
        <!-- Kartu Prediksi -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card bg-primary text-white h-100 shadow card-animated">
                <div class="card-body d-flex align-items-center transition-hover">
                    <i class="fas fa-brain fa-2x me-3 icon-hidden"></i>
                    <div class="text-bold transition-text">Prediksi</div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a class="small text-white stretched-link" href="{{ route('prediksi') }}">Lihat Lebih Lanjut!</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Kartu Histori -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card bg-success text-white h-100 shadow card-animated">
                <div class="card-body d-flex align-items-center transition-hover">
                    <i class="fas fa-history fa-2x me-3 icon-hidden"></i>
                    <div class="text-bold transition-text">Histori Prediksi</div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a class="small text-white stretched-link" href="{{ route('hasil.index') }}">Lihat Lebih Lanjut!</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Kartu Tentang Aplikasi -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card bg-info text-white h-100 shadow card-animated">
                <div class="card-body d-flex align-items-center transition-hover">
                    <i class="fas fa-info-circle fa-2x me-3 icon-hidden"></i>
                    <div class="text-bold transition-text">Tentang Aplikasi</div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a class="small text-white stretched-link" href="{{ route('about') }}">Lihat Lebih Lanjut!</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Histori Terbaru -->
    <div class="card shadow mb-4" style="border: 1px solid #ccc;">
        <div class="card-header text-white" style="background-color: #6c757d;">
            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i> Histori Hasil Prediksi Terbaru</h5>
        </div>
        <div class="card-body" style="background-color: #f0f4f8;">
            @include('partials.tabel-hasil')
        </div>
    </div>
</div>
@endsection

<!-- Perbaikan: Menambahkan link untuk file CSS dan JS menggunakan fungsi secure_asset() untuk memastikan HTTPS -->
<link href="{{ secure_asset('assets/css/styles.css') }}" rel="stylesheet">
<script src="{{ secure_asset('assets/js/scripts.js') }}"></script>
