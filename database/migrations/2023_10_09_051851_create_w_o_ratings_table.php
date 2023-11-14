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
        Schema::create('w_o_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_couple_id');
            $table->unsignedBigInteger('w_organizer_id');
            $table->float('rating', 8, 1);
            $table->string('komentar');
            $table->timestamps();

            $table->foreign('w_couple_id')->references('id')->on('w_couples')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('w_o_ratings');
    }
};
