<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_prediksis', function (Blueprint $table) {
            $table->float('ensemble_prob_kering')->nullable();
            $table->float('ensemble_prob_normal')->nullable();
            $table->float('ensemble_prob_basah')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('hasil_prediksis', function (Blueprint $table) {
            $table->dropColumn([
                'ensemble_prob_kering',
                'ensemble_prob_normal',
                'ensemble_prob_basah',
            ]);
        });
    }
};
