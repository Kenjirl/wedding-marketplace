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
            $table->string('p_lengkap');
            $table->string('p_sapaan');
            $table->string('p_ayah');
            $table->string('p_ibu');

            $table->string('w_lengkap');
            $table->string('w_sapaan');
            $table->string('w_ayah');
            $table->string('w_ibu');
            $table->softDeletes();
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
