<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('data_cuaca', function (Blueprint $table) {
        $table->id();
        $table->string('Tahun')->nullable();
        $table->string('Stasiun')->nullable();
        $table->string('Bulan')->nullable();
        $table->float('Curah_Hujan')->nullable();
        $table->float('Lama_Penyinaran_Matahari_Persen')->nullable();
        $table->float('Suhu_Maksimum')->nullable();
        $table->float('Suhu_RataRata')->nullable();
        $table->float('Suhu_Minimum')->nullable();
        $table->float('SPI_3bulan')->nullable();
        $table->float('curahhujan_3month')->nullable();
        $table->string('Label_Kekeringan')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_cuaca');
    }
};
