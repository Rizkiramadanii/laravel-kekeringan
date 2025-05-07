@extends('layouts.layout')

@section('title', 'Histori Hasil Prediksi')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4 text-dark fw-bold"><i class="fas fa-history"></i> Histori Hasil Prediksi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Histori Hasil Prediksi</li>
    </ol>

    <div class="row">
        <!-- Filter Form -->
        <div class="col-xl-12 mb-4">
            <div class="card shadow">
                <div class="card-header text-white" style="background-color: #6c757d;">
                    <h5 class="mb-0">Filter Prediksi</h5>
                </div>
                <div class="card-body" style="background-color: #f0f4f8;">
                    <form method="GET" action="{{ route('hasil.index') }}" class="row g-4 align-items-end">
                        <div class="col-md-3">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select name="bulan" id="bulan" class="form-select">
                                <option value="">-- Semua Bulan --</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="number" name="tahun" id="tahun" class="form-control"
                                   value="{{ request('tahun') }}" placeholder="Contoh: 2025">
                        </div>
                        <div class="col-md-3 text-end">
                            <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
                        </div>
                        <div class="col-md-3 text-end">
                            <a href="{{ route('hasil.index') }}" class="btn btn-secondary w-100">Reset Filter</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Hasil Prediksi -->
    <div class="card shadow mb-4">
        <div class="card-header text-white" style="background-color: #6c757d;">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i> Tabel Hasil Prediksi</h5>
        </div>
        <div class="card-body" style="background-color: #f0f4f8;">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="prediksiTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Stasiun</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Label</th>
                            <th>Confidence</th>
                            <th>Prob. Kering</th>
                            <th>Prob. Normal</th>
                            <th>Prob. Basah</th>
                            <th>Input Pengguna</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hasilPrediksi as $hasil)
                            <tr class="@if($hasil->label == 'Kering') bg-danger 
                                        @elseif($hasil->label == 'Normal') bg-success 
                                        @elseif($hasil->label == 'Basah') bg-info @endif text-white">
                                <td>{{ $hasil->nama_stasiun }}</td>
                                <td>{{ $hasil->bulan }}</td>
                                <td>{{ $hasil->tahun }}</td>
                                <td><strong>{{ $hasil->label }}</strong></td>
                                <td>{{ $hasil->confidence }}%</td>
                                <td>{{ $hasil->kering }}%</td>
                                <td>{{ $hasil->normal }}%</td>
                                <td>{{ $hasil->basah }}%</td>
                                <td>
                                    @if ($hasil->prediksi)
                                        @php
                                            $inputArray = [];
                                            foreach ($hasil->prediksi->getAttributes() as $key => $value) {
                                                if (!in_array($key, ['id', 'created_at', 'updated_at'])) {
                                                    $inputArray[] = "$key = $value";
                                                }
                                            }
                                            echo implode(', ', $inputArray);
                                        @endphp
                                    @else
                                        <em>Data tidak ditemukan</em>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('hasil.show', $hasil->id) }}" class="btn btn-sm btn-light text-dark">Lihat Detail</a>
                                </td>
                                <td>
                                    <!-- Hapus Form -->
                                    <form action="{{ route('hasil.delete', $hasil->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">Belum ada data prediksi yang tersimpan.</td>
                            </tr>
                        @endforelse
                    </tbody>                            
                </table>
            </div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#prediksiTable').DataTable({
            "searching": true,  
            "columnDefs": [
                {
                    "targets": [1, 2], 
                    "type": "num"
                }
            ]
        });
    });
</script>

@endsection
