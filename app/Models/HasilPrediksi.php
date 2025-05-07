<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prediksi;

class HasilPrediksi extends Model
{
    protected $table = 'hasilprediksi';

    protected $fillable = [
        'bulan', 'tahun', 'label', 'confidence',
        'kering', 'normal', 'basah',
        'predictions', 'probabilities',
        'prediksi_id', // pastikan kolom ini ada di database
    ];

    protected $casts = [
        'predictions' => 'array',
        'probabilities' => 'array',
    ];

    // Relasi ke model Prediksi
    public function prediksi()
    {
        return $this->belongsTo(Prediksi::class, 'prediksi_id');
    }
}
