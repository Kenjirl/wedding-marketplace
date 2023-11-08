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
            $table->unsignedBigInteger('wedding_couple_id');
            $table->unsignedBigInteger('wedding_organizer_id');
            $table->float('rating', 8, 1);
            $table->string('komentar');
            $table->timestamps();

            $table->foreign('wedding_couple_id')->references('id')->on('wedding_couples')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('wedding_organizer_id')->references('id')->on('wedding_organizers')->onUpdate('cascade')->onDelete('cascade');
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
