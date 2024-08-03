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
        Schema::create('w_c_invitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_c_wedding_id');
            $table->json('header')->nullable();
            $table->json('quote')->nullable();
            $table->json('profile')->nullable();
            $table->json('event')->nullable();
            $table->json('gallery')->nullable();
            $table->json('wish')->nullable();
            $table->json('info')->nullable();
            $table->json('footer')->nullable();

            $table->enum('status', ['belum selesai', 'selesai'])->default('belum selesai');

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
        Schema::dropIfExists('w_c_invitations');
    }
};
