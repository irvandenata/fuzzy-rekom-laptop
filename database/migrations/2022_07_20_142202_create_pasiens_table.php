<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('kelurahan_id');
            $table->string('nama_pasien');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->string('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->timestamps();
            $table->foreign('kelurahan_id')->references('id')->on('kelurahans')->onUpdate('CASCADE')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasiens');
    }
}
