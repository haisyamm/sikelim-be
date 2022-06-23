<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatih', function (Blueprint $table) {
            $table->id();
            $table->integer('nik')->unique();
            $table->string('name');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('lisensi');
            $table->string('bidang');
            $table->string('nohp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelatih');
    }
}
