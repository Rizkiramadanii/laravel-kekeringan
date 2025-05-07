<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilPrediksisTable extends Migration
{
    public function up()
    {
        Schema::create('hasil_prediksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');  // Reference to admins table
            $table->string('bulan');
            $table->string('ensemble_label');
            $table->decimal('ensemble_confidence', 5, 2);
            // Add other necessary columns

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_prediksis');
    }
}
