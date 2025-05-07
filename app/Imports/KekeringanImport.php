<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Session;

class KekeringanImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Ubah ke array biasa dan buang header (baris pertama)
        $data = $rows->toArray();
        array_shift($data); // Buang baris header

        // Simpan data mentah untuk referensi (misalnya ambil nama stasiun, bulan, tahun dari baris pertama)
        Session::put('raw_imported_data', $data);

        $slidingData = [];

        // Sliding window 3 bulan
        for ($i = 0; $i <= count($data) - 3; $i++) {
            $mergedRow = [];

            for ($j = 0; $j < 3; $j++) {
                $row = $data[$i + $j];

                $mergedRow = array_merge($mergedRow, [
                    $row[8],  // SPI_3bulan
                    $row[9],  // curahhujan_3month
                    $row[5],  // Suhu_Maksimum
                    $row[6],  // Suhu_RataRata
                    $row[7],  // Suhu_Minimum
                    $row[3],  // Curah_Hujan
                    $row[4],  // Lama_Penyinaran_Matahari_Persen
                ]);
            }

            $slidingData[] = $mergedRow;
        }

        // Simpan hasil sliding ke session
        Session::put('imported_data', $slidingData);
    }
}
