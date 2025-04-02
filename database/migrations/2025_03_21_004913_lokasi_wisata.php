<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LokasiWisata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->id('id_wisata');
            $table->string('nama_wisata', 100);
            $table->text('deskripsi');
            $table->string('alamat', 255);
            $table->unsignedBigInteger('id_kategori');
            $table->decimal('lat', 10, 8)->nullable(false); // Latitude dengan format DECIMAL
            $table->decimal('long', 11, 8)->nullable(false); // Longitude dengan format DECIMAL
            $table->string('gambar_a')->nullable();
            $table->string('gambar_b')->nullable();

            // Foreign Key constraint
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wisata');
    }
}
