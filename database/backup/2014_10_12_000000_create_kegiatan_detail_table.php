<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailkegiatan', function (Blueprint $table) {
            $table->id();
            $table->integer('nisn')->unique();
            $table->text('nama');
            $table->text('posisi');
            $table->text('kondisi');
            $table->text('no_punggung');
            $table->text('ket');
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
        Schema::dropIfExists('detailkegiatan');
    }
}
