@extends('layouts.layout')

@section('title', 'Detail Hasil Prediksi Kekeringan')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4 text-dark fw-bold text-center"><i class="fas fa-chart-line"></i> Detail Hasil Prediksi Kekeringan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('hasil.index') }}">Hasil Prediksi</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <!-- Informasi Umum -->
    <div class="card shadow mb-4 border-primary">
        <div class="card-header fw-bold bg-primary text-white">Informasi Umum</div>
        <div class="card-body row g-3">
            <div class="col-md-6"><strong>Bulan:</strong> {{ $hasil->bulan }}</div>
            <div class="col-md-6"><strong>Tahun:</strong> {{ $hasil->tahun }}</div>
            <div class="col-md-6"><strong>Label Akhir:</strong> {{ $hasil->label }}</div>
            <div class="col-md-6"><strong>Confidence:</strong> {{ $hasil->confidence }}%</div>
        </div>
    </div>

    <!-- Input Pengguna -->
    <div class="card shadow mb-4 border-secondary">
        <div class="card-header fw-bold bg-secondary text-white">Input Pengguna</div>
        <div class="card-body">
            @if ($hasil->prediksi)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Fitur</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil->prediksi->getAttributes() as $key => $value)
                                @if (!in_array($key, ['id', 'created_at', 'updated_at']))
                                    <tr>
                                        <td class="fw-semibold text-capitalize">{{ str_replace('_', ' ', $key) }}</td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Data input tidak tersedia.</p>
            @endif
        </div>
    </div>

    <!-- Hasil Semua Model -->
    <div class="card shadow mb-4 border-dark">
        <div class="card-header fw-bold bg-dark text-white">Hasil Prediksi Semua Model</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr class="table-active">
                        <th>Model</th>
                        <th>Kering</th>
                        <th>Normal</th>
                        <th>Basah</th>
                        <th>Label</th>
                        <th>Confidence</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($predictions as $model => $result)
                        @if($model != 'Voting Ensemble')
                            <tr class="text-white fw-semibold 
                                @if($result['label'] == 'Kering') bg-danger 
                                @elseif($result['label'] == 'Normal') bg-success 
                                @elseif($result['label'] == 'Basah') bg-info @endif">
                                <td>{{ $model }}</td>
                                <td>{{ $probabilities[$model]['Kering'] }}%</td>
                                <td>{{ $probabilities[$model]['Normal'] }}%</td>
                                <td>{{ $probabilities[$model]['Basah'] }}%</td>
                                <td>{{ $result['label'] }}</td>
                                <td>{{ $result['confidence'] }}%</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Voting Ensemble -->
    <div class="card shadow mb-4 border-success">
        <div class="card-header fw-bold bg-success text-white">Prediksi Akhir (Voting Ensemble)</div>
        <div class="card-body">
            @php $ensemble = $predictions['Voting Ensemble']; @endphp
            <ul class="list-group mb-3">
                <li class="list-group-item fw-semibold bg-light">
                    <i class="fas fa-tags me-2 text-dark"></i><strong>Label:</strong> {{ $ensemble['label'] }}
                </li>
                <li class="list-group-item fw-semibold bg-light">
                    <i class="fas fa-percentage me-2 text-dark"></i><strong>Confidence:</strong> {{ $ensemble['confidence'] }}%
                </li>
            </ul>

            <h5>Probabilitas Voting Ensemble</h5>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr class="table-active">
                            <th>Kering</th>
                            <th>Normal</th>
                            <th>Basah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-white fw-semibold 
                            @if($ensemble['label'] == 'Kering') bg-danger 
                            @elseif($ensemble['label'] == 'Normal') bg-success 
                            @elseif($ensemble['label'] == 'Basah') bg-info @endif">
                            <td>{{ $probabilities['Voting Ensemble']['Kering'] }}%</td>
                            <td>{{ $probabilities['Voting Ensemble']['Normal'] }}%</td>
                            <td>{{ $probabilities['Voting Ensemble']['Basah'] }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    @if (!empty($hasil->chart_base64))
        <div class="card shadow mb-5 border-info">
            <div class="card-header fw-bold bg-info text-white">Grafik Probabilitas</div>
            <div class="card-body text-center">
                <img src="data:image/png;base64,{{ $hasil->chart_base64 }}" alt="Grafik" class="img-fluid rounded shadow">
            </div>
        </div>
    @endif
</div>

<!-- Footer -->
<footer class="py-4 bg-light mt-auto border-top">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Hak Cipta &copy; Prediksi Kekeringan 2025</div>
        </div>
    </div>
</footer>
@endsection
