@extends('layouts.layout')

@section('title', 'Tentang Kami')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-dark fw-bold text-center"><i class="fas fa-info-circle"></i> TENTANG KAMI</h1><br>

    <div class="row mb-5 align-items-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-laptop-code me-2"></i> Sistem Prediksi Kekeringan Meteorologi</h5>
                </div>
                <div class="card-body">
                    <p class="text-justify">
                        Website ini merupakan bagian dari Laporan Kerja Praktik dengan judul
                        <strong>"Sistem Prediksi Kekeringan Meteorologi Berbasis Machine Learning"</strong>.
                    </p>
                    <p class="text-justify">
                        Sistem ini dirancang untuk membantu petugas BMKG dalam memprediksi kemungkinan terjadinya kekeringan meteorologi di bulan ke-4 berdasarkan data iklim dari tiga bulan sebelumnya. Dengan memanfaatkan algoritma <strong>Machine Learning</strong>, sistem ini akan menganalisis data historis untuk mengklasifikasikan kondisi bulan ke-4 ke dalam tiga kategori <strong>kering</strong>, <strong>normal</strong>, atau <strong>basah</strong>.
                    </p>
                    <p class="text-justify">
                        Untuk melakukan prediksi, pengguna wajib menginput sebanyak <strong>21 fitur</strong> yang mewakili data iklim selama 3 bulan sebelumnya, yaitu:
                    </p>
                    <ul>
                        <li><strong>SPI 3 Bulan</strong> – 3 nilai (bulan ke-1, ke-2, ke-3)</li>
                        <li><strong>Curah Hujan Bulanan</strong> – 3 nilai</li>
                        <li><strong>Suhu Maksimum</strong> – 3 nilai</li>
                        <li><strong>Suhu Rata-Rata</strong> – 3 nilai</li>
                        <li><strong>Suhu Minimum</strong> – 3 nilai</li>
                        <li><strong>Curah Hujan Harian</strong> – 3 nilai</li>
                        <li><strong>Lama Penyinaran Matahari (%)</strong> – 3 nilai</li>
                    </ul>
                    <p class="text-justify">
                        Total seluruh fitur input adalah <strong>21 variabel</strong> (7 jenis data × 3 bulan). Setelah semua data dimasukkan, sistem akan memproses dan menampilkan hasil prediksi dalam bentuk label klasifikasi dan visualisasi grafik untuk memudahkan pemahaman.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <img src="{{ asset('assets/img/logo-bmkg.png') }}" alt="Logo BMKG"
                 class="img-fluid rounded-circle border border-primary p-2 shadow"
                 style="max-height: 300px;">
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-building me-2"></i> Tentang BMKG Kota Bengkulu</h5>
        </div>
        <div class="card-body">
            <p class="text-justify">
                <strong>BMKG Kota Bengkulu</strong> merupakan lembaga resmi pemerintah yang memiliki peran penting dalam pengamatan dan penyediaan informasi meteorologi, klimatologi, dan geofisika. Melalui data yang dikumpulkan dari pos hujan dan pengamatan iklim, BMKG Bengkulu mendukung upaya mitigasi bencana, pengelolaan sumber daya air, pertanian, dan perencanaan wilayah.
            </p>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-bullseye me-2"></i> Harapan dan Tujuan</h5>
        </div>
        <div class="card-body">
            <p class="text-justify">
                Diharapkan sistem ini dapat memberikan kontribusi nyata dalam mendukung pengambilan keputusan berbasis data, serta meningkatkan efisiensi dan akurasi dalam proses prediksi kekeringan di wilayah Bengkulu dan sekitarnya.
            </p>
        </div>
    </div>
</div>
@endsection
