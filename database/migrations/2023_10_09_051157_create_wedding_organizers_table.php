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
        Schema::create('wedding_organizers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama_pemilik');
            $table->string('nama_perusahaan');
            $table->string('no_telp');
            $table->string('alamat');
            $table->string('lat');
            $table->string('long');
            $table->enum('basis_operasi', ['Hanya di Dalam Kota', 'Bisa ke Luar Kota']);
            $table->string('kota_operasi');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wedding_organizers');
    }
};
