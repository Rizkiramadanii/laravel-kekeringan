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
    Schema::table('hasilprediksi', function (Blueprint $table) {
        $table->unsignedBigInteger('admin_id')->nullable()->after('id');

        // Jika ada tabel admin dan relasinya ingin dibuat:
        // $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('hasilprediksi', function (Blueprint $table) {
        $table->dropColumn('admin_id');
    });
}

};
