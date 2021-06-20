<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->foreignId('patient_id')->index('fk_appointments_patient_idx')->nullable();
            $table->foreign('patient_id', 'fk_appointments_patient')->references('person_id')->on('patients')->onUpdate('no action')->onDelete('set null');
            $table->foreignId('doctor_id')->index('fk_appointments_doctor_idx')->nullable();
            $table->foreign('doctor_id', 'fk_appointments_doctor')->references('person_id')->on('doctors')->onUpdate('no action')->onDelete('set null');
            $table->foreignId('type_id')->index('fk_appointments_type_idx')->nullable();
            $table->foreign('type_id', 'fk_appointments_type')->references('id')->on('appointments_types')->onUpdate('no action')->onDelete('set null');
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
        Schema::dropIfExists('appointments');
    }
}
