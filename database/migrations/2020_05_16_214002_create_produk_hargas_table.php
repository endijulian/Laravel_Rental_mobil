<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukHargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_harga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->string('deskripsi');
            $table->string('harga');
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produk')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_harga');
    }
}
