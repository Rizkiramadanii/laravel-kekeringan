<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\Prediksi; // Pastikan model Prediksi diimport
use Maatwebsite\Excel\Facades\Excel;

class PredictionController extends Controller
{
    // Menampilkan halaman form input prediksi
    public function index()
    {
        return view('prediksi');
    }

    // Mengirim data ke Flask API dan menerima hasil prediksi
    public function prediksi(Request $request)
    {
        // Validasi data input dari user
        $validator = Validator::make($request->all(), [
            'SPI_3bulan_1' => 'required|numeric',
            'curahhujan_3month_1' => 'required|numeric',
            'Suhu_Maksimum_1' => 'required|numeric',
            'Suhu_RataRata_1' => 'required|numeric',
            'Suhu_Minimum_1' => 'required|numeric',
            'Curah_Hujan_1' => 'required|numeric',
            'Lama_Penyinaran_Matahari_Persen_1' => 'required|numeric',

            'SPI_3bulan_2' => 'required|numeric',
            'curahhujan_3month_2' => 'required|numeric',
            'Suhu_Maksimum_2' => 'required|numeric',
            'Suhu_RataRata_2' => 'required|numeric',
            'Suhu_Minimum_2' => 'required|numeric',
            'Curah_Hujan_2' => 'required|numeric',
            'Lama_Penyinaran_Matahari_Persen_2' => 'required|numeric',

            'SPI_3bulan_3' => 'required|numeric',
            'curahhujan_3month_3' => 'required|numeric',
            'Suhu_Maksimum_3' => 'required|numeric',
            'Suhu_RataRata_3' => 'required|numeric',
            'Suhu_Minimum_3' => 'required|numeric',
            'Curah_Hujan_3' => 'required|numeric',
            'Lama_Penyinaran_Matahari_Persen_3' => 'required|numeric',
        ]);

        // Jika validasi gagal, kembali ke form dengan error
        if ($validator->fails()) {
            return redirect()->route('prediksi')
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil data input
        $data = $request->only([
            'SPI_3bulan_1', 'curahhujan_3month_1', 'Suhu_Maksimum_1', 'Suhu_RataRata_1', 'Suhu_Minimum_1', 'Curah_Hujan_1', 'Lama_Penyinaran_Matahari_Persen_1',
            'SPI_3bulan_2', 'curahhujan_3month_2', 'Suhu_Maksimum_2', 'Suhu_RataRata_2', 'Suhu_Minimum_2', 'Curah_Hujan_2', 'Lama_Penyinaran_Matahari_Persen_2',
            'SPI_3bulan_3', 'curahhujan_3month_3', 'Suhu_Maksimum_3', 'Suhu_RataRata_3', 'Suhu_Minimum_3', 'Curah_Hujan_3', 'Lama_Penyinaran_Matahari_Persen_3'
        ]);

        // Simpan data input ke dalam tabel prediksi
        $prediksi = Prediksi::create($data);
        session(['prediksi_id' => $prediksi->id]);

        // Kirim data ke Flask API untuk prediksi
        try {
            $response = Http::post('http://185.201.8.131:5000/predict', $data);

            if ($response->successful()) {
                $result = $response->json();

                return redirect()->route('hasil')->with([
                    'predictions' => $result['predictions'],
                    'probabilities' => $result['probabilities'],
                    'chart' => $result['chart']
                ]);
            } else {
                return redirect()->back()->with('error', 'Flask API gagal: ' . $response->status());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam menghubungi Flask API: ' . $e->getMessage());
        }
    }

    // Menampilkan hasil prediksi
    public function hasil()
    {
        // Ambil data dari session
        $predictions = session('predictions', []);
        $probabilities = session('probabilities', []);
        $chart = session('chart', '');

        // Tampilkan halaman hasil
        return view('hasil', compact('predictions', 'probabilities', 'chart'));
    }
    public function import(Request $request)
{
    $request->validate([
        'file_excel' => 'required|file|mimes:xls,xlsx,csv'
    ]);

    try {
        // Ambil data Excel sebagai collection (sheet pertama)
        $collection = Excel::toCollection(null, $request->file('file_excel'))[0];

        // Ambil 3 baris terakhir data
        $lastThreeRows = $collection->slice(-3)->values();

        if ($lastThreeRows->count() < 3) {
            return redirect()->back()->with('error', 'File harus memiliki minimal 3 baris data.');
        }

        $input = [];

        for ($i = 0; $i < 3; $i++) {
            $row = $lastThreeRows[$i];

            $input["SPI_3bulan_" . ($i + 1)] = $row[8] ?? null; // SPI_3bulan
            $input["curahhujan_3month_" . ($i + 1)] = $row[9] ?? null; // curahhujan_3month
            $input["Suhu_Maksimum_" . ($i + 1)] = $row[5] ?? null;
            $input["Suhu_RataRata_" . ($i + 1)] = $row[6] ?? null;
            $input["Suhu_Minimum_" . ($i + 1)] = $row[7] ?? null;
            $input["Curah_Hujan_" . ($i + 1)] = $row[3] ?? null;
            $input["Lama_Penyinaran_Matahari_Persen_" . ($i + 1)] = $row[4] ?? null;

        }

        // Simpan ke database
        $prediksi = Prediksi::create($input);
        session(['prediksi_id' => $prediksi->id]);

        // Kirim ke Flask API
        $response = Http::post('http://185.201.8.131:5000/predict', $input);

        if ($response->successful()) {
            $result = $response->json();

            // Simpan hasil ke session (agar bisa ditampilkan di route hasil)
            return redirect()->route('hasil')->with([
                'predictions' => $result['predictions'],
                'probabilities' => $result['probabilities'],
                'chart' => $result['chart']
            ]);
        } else {
            return redirect()->back()->with('error', 'Flask API gagal: ' . $response->status());
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Kesalahan saat memproses file: ' . $e->getMessage());
    }
}


    
}

