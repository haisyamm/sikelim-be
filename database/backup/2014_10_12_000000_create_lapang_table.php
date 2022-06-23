<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLapangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lapang', function (Blueprint $table) {
            $table->id();
            $table->string('namalapang');
            $table->string('alamatlapang');
            $table->string('nopengelola');
            $table->text('latitude');
            $table->text('longitude');
            $table->string('email');
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
        Schema::dropIfExists('lapang');
    }
}
