@extends('layouts.layout')

@section('title', 'Prediksi')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4 text-dark fw-bold"><i class="fas fa-brain"></i> Form Input Prediksi Kekeringan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Prediksi</li>
    </ol>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Import Excel --}}
    <div class="card shadow mb-4" style="border: 1px solid #ccc;">
        <div class="card-header text-white" style="background-color: #28a745;"> {{-- Hijau --}}
            <h5 class="mb-0"><i class="fas fa-file-excel me-2"></i> Import Data Excel untuk Prediksi Cepat</h5>
        </div>
        <div class="card-body" style="background-color: #f4fdf4;">
            <form action="{{ route('prediksi.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="file_excel">Pilih File Excel (.xlsx / .xls)</label>
                        <input type="file" name="file_excel" class="form-control" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload me-2"></i>Upload & Prediksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Form Manual --}}
    <div class="card shadow mb-4" style="border: 1px solid #ccc;">
        <div class="card-header text-white" style="background-color: #007bff;"> {{-- Biru --}}
            <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i> Form Data Input</h5>
        </div>
        <div class="card-body" style="background-color: #f0f4f8;">
            <form action="{{ route('prediksi.prediksi') }}" method="POST">
                @csrf

                @for ($bulan = 1; $bulan <= 3; $bulan++)
                    <div class="border-bottom mb-3 pb-2">
                        <h5 class="text-primary fw-bold mb-3">Bulan {{ $bulan }}</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="SPI_3bulan_{{ $bulan }}">SPI 3 Bulan</label>
                                <input type="number" step="any" name="SPI_3bulan_{{ $bulan }}" value="{{ old('SPI_3bulan_' . $bulan) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="curahhujan_3month_{{ $bulan }}">Curah Hujan 3 Bulan</label>
                                <input type="number" step="any" name="curahhujan_3month_{{ $bulan }}" value="{{ old('curahhujan_3month_' . $bulan) }}" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="Suhu_Maksimum_{{ $bulan }}">Suhu Maksimum</label>
                                <input type="number" step="any" name="Suhu_Maksimum_{{ $bulan }}" value="{{ old('Suhu_Maksimum_' . $bulan) }}" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="Suhu_RataRata_{{ $bulan }}">Suhu Rata-Rata</label>
                                <input type="number" step="any" name="Suhu_RataRata_{{ $bulan }}" value="{{ old('Suhu_RataRata_' . $bulan) }}" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="Suhu_Minimum_{{ $bulan }}">Suhu Minimum</label>
                                <input type="number" step="any" name="Suhu_Minimum_{{ $bulan }}" value="{{ old('Suhu_Minimum_' . $bulan) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Curah_Hujan_{{ $bulan }}">Curah Hujan</label>
                                <input type="number" step="any" name="Curah_Hujan_{{ $bulan }}" value="{{ old('Curah_Hujan_' . $bulan) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Lama_Penyinaran_Matahari_Persen_{{ $bulan }}">Lama Penyinaran Matahari (%)</label>
                                <input type="number" step="any" name="Lama_Penyinaran_Matahari_Persen_{{ $bulan }}" value="{{ old('Lama_Penyinaran_Matahari_Persen_' . $bulan) }}" class="form-control" required>
                            </div>
                        </div>
                    </div>
                @endfor

                <div class="text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane me-2"></i>Prediksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
