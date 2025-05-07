<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_prediksis', function (Blueprint $table) {
            $table->longText('detail_prediksi')->nullable();
            $table->longText('detail_probabilitas')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('hasil_prediksis', function (Blueprint $table) {
            $table->dropColumn(['detail_prediksi', 'detail_probabilitas']);
        });
    }
};
