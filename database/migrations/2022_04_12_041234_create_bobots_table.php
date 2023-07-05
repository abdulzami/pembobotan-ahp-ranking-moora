<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobots', function (Blueprint $table) {
            $table->id('id_bobot');
            $table->unsignedBigInteger('id_kriteria');
            $table->double('nilai');
            $table->timestamps();

            $table->foreign('id_kriteria')->references('id_kriteria')->on('kriterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bobots');
    }
}
