<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_doctors', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->integer("user_id")->nullable();
            $table->integer("hospital_id")->nullable();
            $table->index(['user_id']);
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
        Schema::dropIfExists('master_doctors');
    }
}
