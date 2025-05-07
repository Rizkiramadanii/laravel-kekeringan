{{-- partials/tabel-hasil.blade.php --}}

<style>
    /* Mengatur responsivitas dan lebar tabel */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    /* Styling untuk tabel secara keseluruhan */
    table {
        width: 100%;
        table-layout: auto;
        border-collapse: separate;
        border-spacing: 0;
    }

    /* Penataan untuk header tabel */
    th {
        background-color: #007bff;
        color: #fff;
        text-align: center;
        font-weight: bold;
        padding: 10px;
        font-size: 1rem;
    }

    /* Penataan untuk setiap kolom */
    td {
        text-align: center;
        padding: 10px;
        vertical-align: middle;
    }

    /* Gaya untuk baris tabel */
    tr {
        transition: background-color 0.2s ease;
    }

    tr:nth-child(even) {
        background-color: #f8f9fa; /* Baris genap dengan latar belakang terang */
    }

    tr:hover {
        background-color: #e2e6ea; /* Efek hover untuk baris */
    }

    /* Warna latar belakang untuk label */
    .bg-danger {
        background-color: #dc3545 !important;
    }

    .bg-success {
        background-color: #28a745 !important;
    }

    .bg-info {
        background-color: #17a2b8 !important;
    }

    /* Penataan untuk tombol detail */
    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        border-radius: 0.2rem;
        border: none;
    }

    .btn-light {
        background-color: #f8f9fa;
        color: #343a40;
        box-shadow: 0 0 0.2rem rgba(0,0,0,0.1);
        transition: background-color 0.3s;
    }

    .btn-light:hover {
        background-color: #e2e6ea;
        box-shadow: 0 0 0.5rem rgba(0,0,0,0.15);
    }

    /* Menyesuaikan ukuran font dan padding untuk layar kecil */
    @media (max-width: 768px) {
        th, td {
            font-size: 0.9rem; /* Menurunkan ukuran font pada layar kecil */
            padding: 0.75rem; /* Menyesuaikan padding agar lebih kompak */
        }
    }
</style>

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
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Belum ada data prediksi yang tersimpan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
