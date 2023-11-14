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
        Schema::create('w_o_portofolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_organizer_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('judul');
            $table->date('tanggal');
            $table->text('detail');
            $table->string('lokasi');
            $table->enum('status', ['diterima', 'menunggu konfirmasi', 'ditolak'])->default('menunggu konfirmasi');
            $table->timestamps();

            $table->foreign('w_organizer_id')->references('id')->on('w_organizers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_o_portofolios');
    }
};
