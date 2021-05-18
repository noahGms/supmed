<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialityDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speciality_doctor', function (Blueprint $table) {
            $table->foreignId('doctor_id')->index('fk_speciality_doctor_doctor_idx');
            $table->foreign('doctor_id', 'fk_speciality_doctor_doctor')->references('person_id')->on('doctors')->onUpdate('no action')->onDelete('cascade');
            $table->foreignId('speciality_id')->index('fk_speciality_doctor_speciality_idx');
            $table->foreign('speciality_id', 'fk_speciality_doctor_speciality')->references('id')->on('specialities')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('speciality_doctor');
    }
}
