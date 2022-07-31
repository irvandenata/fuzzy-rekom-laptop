<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('tipe');
            $table->integer('tahun');
            $table->string('processor');
            $table->double('speed_processor');
            $table->integer('ram');
            $table->integer('speed_ram');
            $table->integer('storage');
            $table->integer('speed_read');
            $table->integer('speed_write');
            $table->bigInteger('harga');
            $table->string('imagePath')->nullable();
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
        Schema::dropIfExists('products');
    }
}
