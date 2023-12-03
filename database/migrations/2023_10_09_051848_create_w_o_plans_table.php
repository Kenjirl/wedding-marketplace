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
        Schema::create('w_o_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_organizer_id');
            $table->string('nama');
            $table->unsignedBigInteger('harga');
            $table->boolean('deleted')->default(false);
            $table->timestamps();

            $table->foreign('w_organizer_id')->references('id')->on('w_organizers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_o_plans');
    }
};
