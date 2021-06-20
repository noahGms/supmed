<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordSpecialityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyword_speciality', function (Blueprint $table) {
            $table->foreignId('speciality_id')->index('fk_keyword_speciality_speciality_idx');
            $table->foreign('speciality_id', 'fk_keyword_speciality_speciality')->references('id')->on('specialities')->onUpdate('no action')->onDelete('cascade');
            $table->foreignId('keyword_id')->index('fk_keyword_speciality_keyword_idx');
            $table->foreign('keyword_id', 'fk_keyword_speciality_keyword')->references('id')->on('keywords')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keyword_speciality');
    }
}
