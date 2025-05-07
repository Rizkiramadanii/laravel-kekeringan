<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrediksiTable extends Migration
{
    public function up()
    {
        Schema::create('prediksi', function (Blueprint $table) {
            $table->id();
            $table->float('SPI_3bulan_1');
            $table->float('curahhujan_3month_1');
            $table->float('Suhu_Maksimum_1');
            $table->float('Suhu_RataRata_1');
            $table->float('Suhu_Minimum_1');
            $table->float('Curah_Hujan_1');
            $table->float('Lama_Penyinaran_Matahari_Persen_1');
            
            $table->float('SPI_3bulan_2');
            $table->float('curahhujan_3month_2');
            $table->float('Suhu_Maksimum_2');
            $table->float('Suhu_RataRata_2');
            $table->float('Suhu_Minimum_2');
            $table->float('Curah_Hujan_2');
            $table->float('Lama_Penyinaran_Matahari_Persen_2');
            
            $table->float('SPI_3bulan_3');
            $table->float('curahhujan_3month_3');
            $table->float('Suhu_Maksimum_3');
            $table->float('Suhu_RataRata_3');
            $table->float('Suhu_Minimum_3');
            $table->float('Curah_Hujan_3');
            $table->float('Lama_Penyinaran_Matahari_Persen_3');
            
            $table->timestamps(); // Menyimpan waktu pembuatan dan pembaruan data
        });
    }

    public function down()
    {
        Schema::dropIfExists('prediksi');
    }
}
