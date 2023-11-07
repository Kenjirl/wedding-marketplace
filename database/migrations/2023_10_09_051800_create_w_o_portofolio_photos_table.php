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
        Schema::create('w_o_portofolio_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_o_portofolio_id');
            $table->string('url');
            $table->boolean('rejected')->default(false);
            $table->timestamps();

            $table->foreign('w_o_portofolio_id')->references('id')->on('w_o_portofolios')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_o_portofolio_photos');
    }
};
