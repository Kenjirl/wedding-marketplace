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
        Schema::create('wedding_guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wedding_id');
            $table->string('nama');
            $table->string('no_telp');
            $table->enum('gender', ['Pria', 'Wanita']);
            $table->string('link')->nullable();
            $table->enum('status', ['Terkirim', 'Belum Terkirim'])->default('Belum Terkirim');
            $table->enum('respon', ['Hadir', 'Belum Menjawab', 'Tidak Hadir'])->default('Belum Menjawab');
            $table->enum('alasan', ['-', 'Sakit', 'Urusan Pekerjaan', 'Urusan Keluarga', 'Kendala Lainnya'])->default('-');
            $table->integer('jumlah')->default(0);
            $table->text('pesan')->nullable();
            $table->integer('deleted')->default(0);
            $table->timestamps();

            $table->foreign('wedding_id')->references('id')->on('weddings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wedding_guests');
    }
};