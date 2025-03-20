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
            $table->increments('id_ulasan'); // PRIMARY KEY
            $table->integer('id_wisata'); // FOREIGN KEY ke wisata
            $table->text('komentar');
            $table->decimal('rating', 5, 0); // decimal(5,0) sesuai SQL-mu
            $table->dateTime('tanggal');

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
