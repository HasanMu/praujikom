<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quran_surah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('asma');
            $table->string('arti');
            $table->unsignedBigInteger('jml_ayat');
            $table->string('type');
            $table->text('keterangan');
            $table->timestamps();
        });

        Schema::create('quran_ayat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('qs_id');
            $table->text('arab');
            $table->text('arti');
            $table->text('latin');
            $table->text('ayat');

            $table->foreign('qs_id')->references('id')->on('quran_surah')->onDelete('cascade');
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
        Schema::dropIfExists('quran_surah');
        Schema::dropIfExists('quran_ayat');
    }
}
