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
        Schema::create('w_photographers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('no_telp');
            $table->enum('gender', ['Pria', 'Wanita'])->nullable();
            $table->enum('basis_operasi', ['Hanya di Dalam Kota', 'Bisa ke Luar Kota']);
            $table->string('kota_operasi')->nullable();
            $table->enum('status', ['Individu', 'Organisasi']);
            $table->string('alamat')->nullable();
            $table->string('foto_profil')->nullable();
            $table->enum('jenis_rekening', ['BCA', 'BNI', 'BRI', 'Mandiri']);
            $table->unsignedBigInteger('no_rekening');
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
        Schema::dropIfExists('w_photographers');
    }
};
