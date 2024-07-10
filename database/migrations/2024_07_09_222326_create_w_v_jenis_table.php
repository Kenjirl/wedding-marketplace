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
        Schema::create('w_v_jenis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_vendor_id');
            $table->unsignedBigInteger('m_jenis_vendor_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('w_vendor_id')->references('id')->on('w_vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('m_jenis_vendor_id')->references('id')->on('m_jenis_vendors')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_v_jenis');
    }
};
