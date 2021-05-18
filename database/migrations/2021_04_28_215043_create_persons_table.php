<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('phone')->nullable();
            $table->string('role')->nullable();
            $table->foreignId('address_id')->index('fk_persons_address_idx')->nullable();
            $table->foreign('address_id', 'fk_persons_address')->references('id')->on('addresses')->onUpdate('no action')->onDelete('set null');
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
        Schema::dropIfExists('persons');
    }
}
