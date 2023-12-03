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
        Schema::create('w_p_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_photographer_id');
            $table->string('nama');
            $table->unsignedBigInteger('harga');
            $table->boolean('deleted')->default(false);
            $table->timestamps();

            $table->foreign('w_photographer_id')->references('id')->on('w_photographers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_p_plans');
    }
};
