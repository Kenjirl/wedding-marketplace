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
        Schema::create('w_o_plan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_o_plan_id');
            $table->string('isi');
            $table->timestamps();

            $table->foreign('w_o_plan_id')->references('id')->on('w_o_plans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_o_plan_details');
    }
};
