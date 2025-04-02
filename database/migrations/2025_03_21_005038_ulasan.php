<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ulasan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('id_ulasan');
            $table->bigInteger('id_wisata')->unsigned(); // Hapus AUTO_INCREMENT/ Harus unsigned
            $table->text('komentar');
            $table->decimal('rating', 2, 1);
            $table->date('tanggal');
            // Foreign Key constraint
            $table->foreign('id_wisata')->references('id_wisata')->on('wisata')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ulasan');
    }
}
