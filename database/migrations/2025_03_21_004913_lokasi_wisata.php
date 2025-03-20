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
            $table->integer('id_wisata')->primary(); // PRIMARY KEY
            $table->string('nama_wisata', 50);
            $table->text('deskripsi');
            $table->string('alamat', 50);
            $table->integer('id_kategori'); // FOREIGN KEY
            $table->decimal('lat', 10, 8); // integer, unsigned (opsional tergantung kebutuhan)
            $table->decimal('long', 11, 8); // integer, unsigned (opsional)

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
