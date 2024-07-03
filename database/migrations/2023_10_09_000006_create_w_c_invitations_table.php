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
            $table->string('t_header')->nullable();
            $table->string('t_quote')->nullable();
            $table->string('t_profile')->nullable();
            $table->string('t_event')->nullable();
            $table->string('t_gallery')->nullable();
            $table->string('t_wish')->nullable();
            $table->string('t_footer')->nullable();

            $table->json('c_header')->nullable();
            $table->json('c_quote')->nullable();
            $table->json('c_profile')->nullable();
            $table->json('c_event')->nullable();
            $table->json('c_gallery')->nullable();
            $table->json('c_wish')->nullable();
            $table->json('c_footer')->nullable();

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
