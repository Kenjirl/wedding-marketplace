<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_c_weddings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_couple_id');
            $table->string('groom');
            $table->string('bride');
            $table->timestamps();

            $table->foreign('w_couple_id')->references('id')->on('w_couples')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_c_weddings');
    }
};
