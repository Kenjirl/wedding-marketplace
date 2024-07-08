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
        Schema::create('w_v_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_v_booking_id');
            $table->string('transaction_time')->nullable();
            $table->string('gross_amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('order_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('signature_key')->nullable();
            $table->string('status_code')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('status_message')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('expiry_time')->nullable();
            $table->string('bank')->nullable();
            $table->string('va_number')->nullable();
            $table->timestamps();

            $table->foreign('w_v_booking_id')->references('id')->on('w_v_bookings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('w_v_transactions');
    }
};
