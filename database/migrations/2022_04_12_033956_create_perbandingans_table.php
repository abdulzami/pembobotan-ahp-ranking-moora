<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbandingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbandingans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kriteria_1');
            $table->unsignedBigInteger('id_kriteria_2');
            $table->double('nilai');

            $table->foreign('id_kriteria_1')->references('id_kriteria')->on('kriterias')->onDelete('cascade');
            $table->foreign('id_kriteria_2')->references('id_kriteria')->on('kriterias')->onDelete('cascade');
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
        Schema::dropIfExists('perbandingans');
    }
}
