<?php

namespace App\Http\Controllers;

use App\Imports\KekeringanImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Prediksi;

class ImportPredictionController extends Controller
{
    public function index()
    {
        return view('import_form');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        try {
            // Import data
            Excel::import(new KekeringanImport, $file);

            $importedData = Session::get('imported_data');
            $rawData = Session::get('raw_imported_data');

            if (empty($importedData) || empty($rawData)) {
                return redirect()->back()->with('error', 'Data import kosong atau gagal.');
            }

            // Ubah nama bulan ke angka
            $bulanMapping = [
                'januari' => 1, 'februari' => 2, 'maret' => 3,
                'april' => 4, 'mei' => 5, 'juni' => 6,
                'juli' => 7, 'agustus' => 8, 'september' => 9,
                'oktober' => 10, 'november' => 11, 'desember' => 12,
            ];

            $namaStasiun = $rawData[0][0];
            $bulanText = strtolower($rawData[0][1]);
            $bulan = $bulanMapping[$bulanText] ?? null;
            $tahun = (int) $rawData[0][2];

            if (!$bulan) {
                return redirect()->back()->with('error', 'Bulan tidak valid: ' . $rawData[0][1]);
            }

            $meta = [
                'nama_stasiun' => $namaStasiun,
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            Session::put('meta_data', $meta);

            // Prediksi via Flask
            $predictions = [];
            $probabilities = [];

            foreach ($importedData as $data) {
                $response = Http::post('http://127.0.0.1:5000/predict', [
                    'SPI_3bulan_1' => $data[0],
                    'curahhujan_3month_1' => $data[1],
                    'Suhu_Maksimum_1' => $data[2],
                    'Suhu_RataRata_1' => $data[3],
                    'Suhu_Minimum_1' => $data[4],
                    'Curah_Hujan_1' => $data[5],
                    'Lama_Penyinaran_Matahari_Persen_1' => $data[6],
                    'SPI_3bulan_2' => $data[7],
                    'curahhujan_3month_2' => $data[8],
                    'Suhu_Maksimum_2' => $data[9],
                    'Suhu_RataRata_2' => $data[10],
                    'Suhu_Minimum_2' => $data[11],
                    'Curah_Hujan_2' => $data[12],
                    'Lama_Penyinaran_Matahari_Persen_2' => $data[13],
                    'SPI_3bulan_3' => $data[14],
                    'curahhujan_3month_3' => $data[15],
                    'Suhu_Maksimum_3' => $data[16],
                    'Suhu_RataRata_3' => $data[17],
                    'Suhu_Minimum_3' => $data[18],
                    'Curah_Hujan_3' => $data[19],
                    'Lama_Penyinaran_Matahari_Persen_3' => $data[20],
                ]);

                if ($response->successful()) {
                    $result = $response->json();
                    $predictions[] = $result['predictions'];
                    $probabilities[] = $result['probabilities'];
                }
            }

            // Simpan ke database jika perlu (opsional)
            foreach ($predictions as $i => $prediction) {
                Prediksi::create([
                    'prediction' => $prediction,
                    'probabilities' => json_encode($probabilities[$i]),
                    'nama_stasiun' => $meta['nama_stasiun'],
                    'bulan' => $meta['bulan'],
                    'tahun' => $meta['tahun'],
                ]);
            }

            // Kirim ke view upload hasil
            return redirect()->route('upload.hasil')->with([
                'predictions' => $predictions,
                'probabilities' => $probabilities,
                'meta_data' => $meta
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
