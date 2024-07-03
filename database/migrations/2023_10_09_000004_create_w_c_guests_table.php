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
        Schema::create('w_c_guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_c_wedding_id');
            $table->string('nama');
            $table->string('no_telp');
            $table->string('link')->nullable();
            $table->enum('status', ['Belum Terkirim', 'Sudah Terkirim'])->default('Belum Terkirim');
            $table->enum('respon', ['Belum Menjawab', 'Hadir', 'Tidak Hadir'])->default('Belum Menjawab');
            $table->unsignedInteger('jumlah')->default(0);
            $table->text('pesan')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('w_c_wedding_id')->references('id')->on('w_c_weddings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_c_guests');
    }
};
