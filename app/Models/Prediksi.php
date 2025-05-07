<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HasilPrediksi;

class Prediksi extends Model
{
    use HasFactory;

    protected $table = 'prediksi'; // Nama tabel yang sesuai

    protected $fillable = [
        'SPI_3bulan_1', 'curahhujan_3month_1', 'Suhu_Maksimum_1', 'Suhu_RataRata_1', 'Suhu_Minimum_1', 'Curah_Hujan_1', 'Lama_Penyinaran_Matahari_Persen_1',
        'SPI_3bulan_2', 'curahhujan_3month_2', 'Suhu_Maksimum_2', 'Suhu_RataRata_2', 'Suhu_Minimum_2', 'Curah_Hujan_2', 'Lama_Penyinaran_Matahari_Persen_2',
        'SPI_3bulan_3', 'curahhujan_3month_3', 'Suhu_Maksimum_3', 'Suhu_RataRata_3', 'Suhu_Minimum_3', 'Curah_Hujan_3', 'Lama_Penyinaran_Matahari_Persen_3',
    ];

    // Relasi ke HasilPrediksi
    public function hasil()
    {
        return $this->hasOne(HasilPrediksi::class, 'prediksi_id');
    }
}
