@extends('layouts.layout')

@section('title', 'Hasil Prediksi Kekeringan')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4 text-dark fw-bold"><i class="fas fa-chart-line"></i> Hasil Prediksi Kekeringan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Hasil Prediksi</li>
    </ol>

    <div class="row">
        <!-- Bagian Hasil Prediksi Model -->
        <div class="col-12">
            @if(session('predictions'))
                <div class="prediction-section">
                    <h3>Hasil Prediksi Model</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="border: 1px solid black;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Model</th>
                                    <th>Kering</th>
                                    <th>Normal</th>
                                    <th>Basah</th>
                                    <th>Label</th>
                                    <th>Confidence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('predictions') as $model => $result)
                                    @if($model != 'Voting Ensemble')
                                        <tr class="@if($result['label'] == 'Kering') bg-danger @elseif($result['label'] == 'Normal') bg-success @elseif($result['label'] == 'Basah') bg-info @endif">
                                            <td><strong>{{ $model }}</strong></td>
                                            <td>{{ session('probabilities')[$model]['Kering'] }}%</td>
                                            <td>{{ session('probabilities')[$model]['Normal'] }}%</td>
                                            <td>{{ session('probabilities')[$model]['Basah'] }}%</td>
                                            <td>{{ $result['label'] }}</td>
                                            <td>{{ $result['confidence'] }}%</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bagian Prediksi Akhir (Voting Ensemble) -->
                <div class="final-model mt-4">
                    <h3>Prediksi Akhir (Voting Ensemble)</h3>
                    @php $ensemble = session('predictions')['Voting Ensemble']; @endphp
                    <ul>
                        <li><strong>Label:</strong> {{ $ensemble['label'] }}</li>
                        <li><strong>Confidence:</strong> {{ $ensemble['confidence'] }}%</li>
                    </ul>

                    <h4>Probabilitas Voting Ensemble</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="border: 1px solid black;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Kering</th>
                                    <th>Normal</th>
                                    <th>Basah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="@if($ensemble['label'] == 'Kering') bg-danger @elseif($ensemble['label'] == 'Normal') bg-success @elseif($ensemble['label'] == 'Basah') bg-info @endif">
                                    <td>{{ session('probabilities')['Voting Ensemble']['Kering'] }}%</td>
                                    <td>{{ session('probabilities')['Voting Ensemble']['Normal'] }}%</td>
                                    <td>{{ session('probabilities')['Voting Ensemble']['Basah'] }}%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Grafik Probabilitas -->
                <div class="chart-container text-center mt-4">
                    <h3>Grafik Probabilitas</h3>
                    <img src="data:image/png;base64,{{ session('chart') }}" alt="Probability Chart" class="img-fluid">
                </div>

                <!-- Tombol untuk menyimpan hasil prediksi -->
                <div class="text-center mt-4">
                    <form action="{{ route('hasil.simpan') }}" method="POST">
                        @csrf

                        <div class="row justify-content-center mb-3">
                            <div class="col-md-6">
                                <label for="nama_stasiun">Nama Stasiun:</label>
                                <input type="text" name="nama_stasiun" id="nama_stasiun" class="form-control" placeholder="Masukkan nama stasiun" required>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-md-3">
                                <label for="bulan">Pilih Bulan:</label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $i => $bulan)
                                        <option value="{{ $i + 1 }}">{{ $bulan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="tahun">Pilih Tahun:</label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    @for($y = date('Y') - 5; $y <= date('Y') + 5; $y++)
                                        <option value="{{ $y }}" @if($y == date('Y')) selected @endif>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="predictions" value="{{ json_encode(session('predictions')) }}">
                        <input type="hidden" name="probabilities" value="{{ json_encode(session('probabilities')) }}">
                        <button type="submit" class="btn btn-success">Simpan Hasil Prediksi</button>
                    </form>
                </div>

            @else
                <div class="alert alert-warning mt-4">
                    Tidak ada hasil prediksi yang ditemukan. Pastikan model telah dijalankan dengan benar.
                </div>
            @endif
        </div>
    </div>

</div>

<!-- Footer -->
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Hak Cipta &copy; Prediksi Kekeringan 2025</div>
            <div>
                <a href="mailto:support@prediksi.com" class="btn btn-link">Hubungi Support</a>
            </div>
        </div>
    </div>
</footer>
@endsection
