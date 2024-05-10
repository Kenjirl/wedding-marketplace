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
            $table->string('t_header');
            $table->string('t_quote');
            $table->string('t_profile');
            $table->json('t_gallery');
            $table->string('t_wish');
            $table->string('t_qr');
            $table->string('t_footer');

            $table->string('c_quote');
            $table->json('c_profile');
            $table->json('c_gallery');
            $table->json('c_qr');
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
